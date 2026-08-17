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
                <a href="/" class="font-semibold">
                    Website Sekolah
                </a>
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
