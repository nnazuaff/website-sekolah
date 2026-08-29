<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10 px-4">

    <a href="{{ route('news.index') }}"
       class="text-blue-600 mb-6 inline-block">
        ← Kembali
    </a>

    @if($article->thumbnail)
        <img src="{{ asset('storage/'.$article->thumbnail) }}"
             class="w-full h-80 object-cover rounded-xl mb-6">
    @endif

    <p class="text-gray-500 mb-2">
        {{ optional($article->published_at)->format('d F Y H:i') }}
    </p>

    <h1 class="text-4xl font-bold mb-6">
        {{ $article->title }}
    </h1>

    <article class="prose max-w-none">
        {!! $article->content !!}
    </article>

</div>

</body>
</html>