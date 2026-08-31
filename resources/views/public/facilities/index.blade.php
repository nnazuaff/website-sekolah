@extends('layouts.public')
@section('title', 'Fasilitas')
@section('content')
<section class="site-hero"><div class="site-hero-inner"><a href="{{ route('home') }}" class="text-sm text-slate-300 hover:text-white">← Kembali ke beranda</a><h1 class="mt-8 text-4xl font-bold">Fasilitas Sekolah</h1><p class="mt-4 text-slate-300">Ruang dan sarana yang mendukung proses belajar siswa.</p></div></section>
<section class="site-section"><div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">@forelse($facilities as $facility)<article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">@if($facility->photo)<img src="{{ Storage::disk('public')->url($facility->photo) }}" alt="{{ $facility->name }}" class="h-56 w-full object-cover">@else<div class="flex h-56 items-center justify-center bg-blue-50 text-slate-400">Foto fasilitas</div>@endif<div class="p-5"><h2 class="text-xl font-semibold">{{ $facility->name }}</h2>@if($facility->description)<p class="mt-3 text-slate-600">{{ $facility->description }}</p>@endif</div></article>@empty<p class="text-slate-500">Belum ada fasilitas yang ditampilkan.</p>@endforelse</div></section>
@endsection
