@extends('layouts.public')

@section('title', 'Daftar Prestasi Sekolah')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">Prestasi Sekolah</h1>
        <p class="mt-3 text-lg text-gray-500">Daftar pencapaian dan penghargaan siswa serta sekolah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($achievements as $achievement)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 flex flex-col justify-between">
                <div>
                    @if ($achievement->photo)
                        <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $achievement->photo) }}" alt="{{ $achievement->title }}">
                    @else
                        <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-400">
                            <span>Tidak ada foto</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $achievement->level }}
                            </span>
                            <span class="text-sm font-semibold text-gray-500">
                                {{ $achievement->year }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $achievement->title }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3">{{ $achievement->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Belum ada data prestasi yang ditampilkan.
            </div>
        @endforelse
    </div>
</div>
@endsection