<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Website Sekolah')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-zinc-900">

    <header>
        <nav class="border-b">
            <div class="mx-auto max-w-7xl px-4 py-4">
                <div class="flex flex-wrap items-center gap-5">
                    <a href="/" class="font-semibold">Website Sekolah</a>
                    <a href="{{ route('majors.index') }}" class="text-sm text-zinc-600 hover:text-zinc-900">Jurusan</a>
                    <a href="{{ route('news.index') }}" class="text-sm text-zinc-600 hover:text-zinc-900">Berita</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 border-t">
        <div class="mx-auto max-w-7xl px-4 py-6 text-sm text-zinc-500">
            Website Sekolah
        </div>
    </footer>

</body>

</html>
