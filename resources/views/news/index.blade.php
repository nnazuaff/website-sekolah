<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Sekolah</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold mb-8">Berita Sekolah</h1>

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($news as $item)

        <div class="bg-white rounded-xl shadow overflow-hidden">

            @if($item->thumbnail)
                <img
                    src="{{ asset('storage/'.$item->thumbnail) }}"
                    alt="{{ $item->title }}"
                    class="w-full h-48 object-cover"
                >
            @endif

            <div class="p-5">

                <p class="text-sm text-gray-500 mb-2">
                    {{ optional($item->published_at)->format('d M Y') }}
                </p>

                <h2 class="font-bold text-lg mb-3">
                    {{ $item->title }}
                </h2>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $item->excerpt }}
                </p>

                <a
                    href="{{ route('news.show',$item->slug) }}"
                    class="text-blue-600 font-semibold"
                >
                    Baca Selengkapnya →
                </a>

            </div>
        </div>

        @empty

        <p>Belum ada berita.</p>

        @endforelse
    </div>

</div>

</body>
</html>