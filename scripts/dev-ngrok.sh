#!/usr/bin/env bash
set -Eeuo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

APP_PORT="${APP_PORT:-8000}"
NGROK_API="${NGROK_API:-http://127.0.0.1:4040/api/tunnels}"
NGROK_LOG="$(mktemp -t website-sekolah-ngrok.XXXXXX.log)"
NGROK_PID=""
PHP_PID=""

get_public_url() {
    curl -fsS --max-time 2 "$NGROK_API" 2>/dev/null \
        | php -r '$data = json_decode(stream_get_contents(STDIN), true); echo $data["tunnels"][0]["public_url"] ?? "";' \
        || true
}

cleanup() {
    set +e
    [[ -n "$PHP_PID" ]] && kill "$PHP_PID" 2>/dev/null
    [[ -n "$NGROK_PID" ]] && kill "$NGROK_PID" 2>/dev/null
    rm -f "$NGROK_LOG"
}
trap cleanup EXIT INT TERM

require_command() {
    command -v "$1" >/dev/null 2>&1 || {
        printf 'Perintah wajib tidak ditemukan: %s\n' "$1" >&2
        exit 1
    }
}

require_command php
require_command composer
require_command npm
require_command ngrok
require_command curl
require_command pgrep

if [[ ! -f .env ]]; then
    printf 'File .env belum ada, membuat dari .env.example...\n'
    cp .env.example .env
    php artisan key:generate --force
fi

if [[ ! -d vendor ]]; then
    printf 'Folder vendor belum ada, menjalankan composer install...\n'
    composer install --no-interaction
fi

if [[ ! -d node_modules ]]; then
    printf 'Folder node_modules belum ada, menjalankan npm install...\n'
    npm install
fi

if [[ "${DB_CONNECTION:-sqlite}" == "sqlite" && ! -f database/database.sqlite ]]; then
    mkdir -p database
    touch database/database.sqlite
fi

if curl -fsS --max-time 1 "http://127.0.0.1:${APP_PORT}" >/dev/null 2>&1; then
    printf 'Port %s sedang digunakan. Hentikan prosesnya atau gunakan APP_PORT lain.\n' "$APP_PORT" >&2
    exit 1
fi

EXISTING_NGROK_PIDS="$(pgrep -f '(^|/)ngrok http' || true)"
if [[ -n "$EXISTING_NGROK_PIDS" ]]; then
    printf 'Proses ngrok lama masih aktif (PID: %s). Hentikan dengan: kill %s\n' \
        "${EXISTING_NGROK_PIDS//$'\n'/ }" "${EXISTING_NGROK_PIDS//$'\n'/ }" >&2
    exit 1
fi

if [[ -n "$(get_public_url)" ]]; then
    printf 'Sudah ada tunnel ngrok aktif di API lokal. Hentikan tunnel lama terlebih dahulu.\n' >&2
    exit 1
fi

php artisan storage:link >/dev/null 2>&1 || true
php artisan migrate --force
php artisan config:clear >/dev/null
php artisan view:clear >/dev/null
npm run build

printf 'Membuka tunnel ngrok ke port %s...\n' "$APP_PORT"
ngrok http "$APP_PORT" --host-header=preserve >"$NGROK_LOG" 2>&1 &
NGROK_PID=$!

PUBLIC_URL=""
for _ in {1..30}; do
    PUBLIC_URL="$(get_public_url)"
    [[ -n "$PUBLIC_URL" ]] && break
    sleep 1
done

if [[ -z "$PUBLIC_URL" ]]; then
    printf 'Tunnel ngrok gagal dibuat. Log:\n' >&2
    sed -n '1,120p' "$NGROK_LOG" >&2
    exit 1
fi

PUBLIC_URL_WITH_BYPASS="${PUBLIC_URL}/?ngrok-skip-browser-warning=true"

# `artisan serve` hanya meneruskan daftar environment terbatas ke proses PHP.
# Jalankan server PHP langsung agar APP_URL dan VITE_FORCE_BUILD tetap tersedia.
(
    cd public
    APP_URL="$PUBLIC_URL" VITE_FORCE_BUILD=true php -S "0.0.0.0:${APP_PORT}" \
        ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php
) >/tmp/website-sekolah-laravel.log 2>&1 &
PHP_PID=$!

for _ in {1..20}; do
    if curl -fsS --max-time 2 "http://127.0.0.1:${APP_PORT}" >/dev/null 2>&1; then
        break
    fi
    sleep 1
done

if ! curl -fsS --max-time 2 "http://127.0.0.1:${APP_PORT}" >/dev/null 2>&1; then
    printf 'Laravel gagal dijalankan. Log:\n' >&2
    sed -n '1,120p' /tmp/website-sekolah-laravel.log >&2
    exit 1
fi

PUBLIC_HOST="${PUBLIC_URL#https://}"
RUNTIME_HTML="$(curl -fsS --max-time 5 \
    -H "Host: ${PUBLIC_HOST}" \
    -H 'X-Forwarded-Proto: https' \
    "http://127.0.0.1:${APP_PORT}")"

if [[ "$RUNTIME_HTML" == *"http://127.0.0.1"* || "$RUNTIME_HTML" == *"http://localhost"* || "$RUNTIME_HTML" == *"http://${PUBLIC_HOST}"* || "$RUNTIME_HTML" != *"https://${PUBLIC_HOST}/build/"* ]]; then
    printf 'Konfigurasi URL publik tidak valid. Asset atau route masih menunjuk ke localhost/http.\n' >&2
    exit 1
fi

printf '\nProject siap diakses:\n'
printf '  Local : http://127.0.0.1:%s\n' "$APP_PORT"
printf '  Ngrok : %s\n' "$PUBLIC_URL_WITH_BYPASS"
printf '\nGunakan URL Ngrok lengkap di atas. Tekan Ctrl+C untuk berhenti.\n\n'

while kill -0 "$NGROK_PID" 2>/dev/null && kill -0 "$PHP_PID" 2>/dev/null; do
    sleep 2
done

printf 'Laravel atau ngrok berhenti.\n'
exit 1
