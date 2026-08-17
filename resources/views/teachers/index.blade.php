<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Guru - Website Sekolah</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .teachers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .teacher-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .teacher-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 15px;
        }

        .no-photo {
            width: 120px;
            height: 120px;
            background: #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: #666;
        }

        .teacher-card h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .teacher-card p {
            margin: 8px 0;
        }
    </style>
</head>

<body>

    <h1>Daftar Guru</h1>

    <div class="teachers">

        @forelse ($teachers as $teacher)

            <div class="teacher-card">

                @if ($teacher->photo)
                    <img
                        src="{{ asset('storage/' . $teacher->photo) }}"
                        alt="{{ $teacher->name }}"
                        class="teacher-photo"
                    >
                @else
                    <div class="no-photo">
                        Tidak ada foto
                    </div>
                @endif

                <h2>{{ $teacher->name }}</h2>

                <p>
                    <strong>NIP:</strong>
                    {{ $teacher->nip }}
                </p>

                <p>
                    <strong>Jabatan:</strong>
                    {{ $teacher->position }}
                </p>

                <p>
                    <strong>Mata Pelajaran:</strong>
                    {{ $teacher->subject }}
                </p>

                @if ($teacher->description)
                    <p>
                        <strong>Deskripsi:</strong>
                        {{ $teacher->description }}
                    </p>
                @endif

            </div>

        @empty

            <p>Belum ada guru yang aktif.</p>

        @endforelse

    </div>

</body>
</html>