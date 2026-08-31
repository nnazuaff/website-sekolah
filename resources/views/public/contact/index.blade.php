@extends('layouts.public')

@section('title', 'Kontak')

@section('content')
    <section class="bg-slate-950 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-300">Kontak</p>
            <h1 class="mt-4 text-4xl font-black tracking-tight sm:text-5xl">Mari terhubung dengan kami.</h1>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        @if ($schoolProfile && ($schoolProfile->address || $schoolProfile->phone || $schoolProfile->email))
            <div class="grid gap-10 lg:grid-cols-[.8fr_1.2fr]">
                <div>
                    <h2 class="text-2xl font-black">Informasi sekolah</h2>
                    <dl class="mt-8 space-y-6">
                        @if ($schoolProfile->address)
                            <div><dt class="text-sm font-bold uppercase tracking-widest text-amber-700">Alamat</dt><dd class="mt-2 leading-7 text-slate-600">{{ $schoolProfile->address }}</dd></div>
                        @endif
                        @if ($schoolProfile->phone)
                            <div><dt class="text-sm font-bold uppercase tracking-widest text-amber-700">Telepon</dt><dd class="mt-2 text-slate-600"><a href="tel:{{ $schoolProfile->phone }}" class="hover:text-amber-700">{{ $schoolProfile->phone }}</a></dd></div>
                        @endif
                        @if ($schoolProfile->email)
                            <div><dt class="text-sm font-bold uppercase tracking-widest text-amber-700">Email</dt><dd class="mt-2 text-slate-600"><a href="mailto:{{ $schoolProfile->email }}" class="hover:text-amber-700">{{ $schoolProfile->email }}</a></dd></div>
                        @endif
                    </dl>
                </div>
                @if ($mapUrl && $mapEmbedUrl)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <iframe src="{{ $mapEmbedUrl }}" title="Lokasi sekolah di Google Maps" class="h-80 w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="p-4"><a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer" class="font-bold text-amber-700 hover:text-amber-800">Buka di Google Maps ↗</a></div>
                    </div>
                @endif
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">Informasi kontak sedang disiapkan.</div>
        @endif
    </section>
@endsection
