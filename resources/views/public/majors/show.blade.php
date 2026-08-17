<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $major->name }}</title>
</head>
<body>
    <a href="{{ route('public.majors.index') }}">&larr; Kembali ke daftar jurusan</a>

    <h1>{{ $major->name }} ({{ $major->short_name }})</h1>

    @if($major->image)
        <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" style="max-width: 500px; height: auto; border-radius: 8px;">
    @endif

    <p style="margin-top: 20px;">{{ $major->description }}</p>
</body>
</html>