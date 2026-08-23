<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Informasi Sekolah')</title>
    <!-- Tailwind CSS CDN untuk keperluan development -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Header / Navbar Sederhana -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-blue-600">Website Sekolah</a>
            <nav class="space-x-4">
                <a href="/prestasi" class="text-gray-600 hover:text-blue-600 font-medium">Prestasi</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Sederhana -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-12 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Website Informasi Sekolah. All rights reserved.</p>
    </footer>

</body>
</html>