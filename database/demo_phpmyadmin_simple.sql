-- ============================================
-- CONTOH SIMPLE Procedure, Function, Trigger, Transaction
-- Untuk phpMyAdmin (MySQL / MariaDB)
-- Database: website-sekolah (sesuaikan nama DB kamu)
-- Cara pakai: buka phpMyAdmin > pilih database > tab SQL > copy-paste per blok
-- ============================================

-- 0. Tabel log untuk demo Trigger (jalankan dulu)
CREATE TABLE IF NOT EXISTS teacher_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id BIGINT UNSIGNED,
    action VARCHAR(50),
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- 1. FUNCTION - Menghitung jumlah guru aktif
-- Memanggil: SELECT get_active_teacher_count();
-- ============================================
DROP FUNCTION IF EXISTS get_active_teacher_count;
DELIMITER //
CREATE FUNCTION get_active_teacher_count()
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE total INT;
    SELECT COUNT(*) INTO total FROM teachers WHERE is_active = 1;
    RETURN total;
END //
DELIMITER ;

-- Test Function:
-- SELECT get_active_teacher_count() AS jumlah_guru_aktif;


-- ============================================
-- 2. PROCEDURE - Ambil berita berdasarkan status
-- Memanggil: CALL get_news_by_status('published');
-- ============================================
DROP PROCEDURE IF EXISTS get_news_by_status;
DELIMITER //
CREATE PROCEDURE get_news_by_status(IN p_status VARCHAR(20))
BEGIN
    SELECT id, title, slug, status, published_at
    FROM news
    WHERE status = p_status
    ORDER BY published_at DESC;
END //
DELIMITER ;

-- Test Procedure:
-- CALL get_news_by_status('published');
-- CALL get_news_by_status('draft');


-- ============================================
-- 3. TRIGGER - Otomatis catat log setiap guru baru ditambahkan
-- Test: INSERT INTO teachers (name, nip, position, subject) VALUES ('Budi Test', '99999', 'Guru', 'RPL');
-- Lalu cek: SELECT * FROM teacher_logs;
-- ============================================
DROP TRIGGER IF EXISTS after_teacher_insert;
DELIMITER //
CREATE TRIGGER after_teacher_insert
AFTER INSERT ON teachers
FOR EACH ROW
BEGIN
    INSERT INTO teacher_logs (teacher_id, action, description)
    VALUES (NEW.id, 'INSERT', CONCAT('Guru baru: ', NEW.name, ' - ', NEW.subject));
END //
DELIMITER ;

-- Trigger tambahan: log saat status guru diubah
DROP TRIGGER IF EXISTS after_teacher_update;
DELIMITER //
CREATE TRIGGER after_teacher_update
AFTER UPDATE ON teachers
FOR EACH ROW
BEGIN
    IF OLD.is_active != NEW.is_active THEN
        INSERT INTO teacher_logs (teacher_id, action, description)
        VALUES (NEW.id, 'UPDATE_STATUS', CONCAT('Status guru ', NEW.name, ' diubah menjadi ', IF(NEW.is_active=1,'aktif','nonaktif')));
    END IF;
END //
DELIMITER ;


-- ============================================
-- 4. TRANSACTION + COMMIT / ROLLBACK
-- Contoh: Insert 2 berita sekaligus, harus sukses semua atau batal semua
-- Jalankan di tab SQL phpMyAdmin baris per baris
-- ============================================

-- Contoh A: COMMIT (berhasil)
START TRANSACTION;
INSERT INTO news (title, slug, excerpt, content, status, created_at, updated_at)
VALUES ('Berita Transaksi 1', 'berita-transaksi-1', 'test', 'Konten test 1', 'draft', NOW(), NOW());
INSERT INTO news (title, slug, excerpt, content, status, created_at, updated_at)
VALUES ('Berita Transaksi 2', 'berita-transaksi-2', 'test', 'Konten test 2', 'draft', NOW(), NOW());
COMMIT;
-- Cek: SELECT * FROM news WHERE slug LIKE 'berita-transaksi-%';

-- Contoh B: ROLLBACK (dibatalkan karena slug duplicate / error)
START TRANSACTION;
INSERT INTO news (title, slug, excerpt, content, status, created_at, updated_at)
VALUES ('Berita Gagal 1', 'berita-gagal-rollback', 'test', 'Konten gagal 1', 'draft', NOW(), NOW());
-- sengaja duplicate slug biar error, lalu rollback:
-- INSERT INTO news (title, slug, excerpt, content, status, created_at, updated_at)
-- VALUES ('Berita Gagal 2', 'berita-gagal-rollback', 'test', 'Konten gagal 2', 'draft', NOW(), NOW());
ROLLBACK;
-- Cek: SELECT * FROM news WHERE slug = 'berita-gagal-rollback'; -- harus 0 baris (sudah di-rollback)

-- Contoh C: Transaction di Laravel (untuk Filament) - tidak dijalankan di phpMyAdmin, tapi di code:
-- DB::transaction(function() {
--     News::create([...]);
--     Teacher::create([...]);
-- }); // otomatis COMMIT jika sukses, ROLLBACK jika ada exception
