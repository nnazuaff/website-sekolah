@extends('layouts.public')
@section('title', 'Fasilitas')
@section('content')
@include('layouts._public-page-header', ['title' => 'Fasilitas Sekolah', 'description' => 'Sarana yang mendukung proses belajar siswa.'])
<section class="site-section"><div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">@forelse($facilities as $facility)<article class="site-card"><div class="image-placeholder">@if($facility->photo)<img src="{{ Storage::disk('public')->url($facility->photo) }}" alt="{{ $facility->name }}" class="h-52 w-full object-cover">@else<span>Foto fasilitas</span>@endif</div><div class="p-5"><h2 class="text-xl font-bold text-brand-950">{{ $facility->name }}</h2>@if($facility->description)<p class="mt-3 text-slate-600">{{ $facility->description }}</p>@endif</div></article>@empty<div class="sm:col-span-2 lg:col-span-3">@include('layouts._public-empty', ['title' => 'Belum ada fasilitas yang ditampilkan'])</div>@endforelse</div></section>
@endsection