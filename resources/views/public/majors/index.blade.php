<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jurusan</title>
</head>
<body>
    <h1>Daftar Jurusan</h1>

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        @forelse($majors as $major)
            <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 250px;">
                @if($major->image)
                    <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px;">
                @endif
                <h2>{{ $major->name }} ({{ $major->short_name }})</h2>
                <p>{{ Str::limit($major->description, 100) }}</p>
                <a href="{{ route('public.majors.show', $major->slug) }}">Lihat Detail</a>
            </div>
        @empty
            <p>Belum ada data jurusan aktif.</p>
        @endforelse
    </div>
</body>
</html>