@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')
    <section class="site-hero">
        <div class="site-hero-inner">
            <p class="site-eyebrow">Informasi sekolah</p>
            <h1 class="mt-3 max-w-3xl text-4xl font-extrabold tracking-tight text-brand-950 sm:text-5xl">Profil Sekolah</h1>
            <p class="mt-4 max-w-2xl text-slate-600">Mengenal sejarah, visi, misi, dan pimpinan SMKN 1 Katapang.</p>
        </div>
    </section>

    <section class="site-section">
        @if ($schoolProfile)
            @php($allowedHtml = '<p><br><strong><em><ul><ol><li><h3><h4>')
            <div class="grid gap-10 lg:grid-cols-[1.1fr_.9fr]">
                <div>
                    <p class="site-eyebrow">Tentang kami</p>
                    <h2 class="mt-3 text-3xl font-extrabold text-brand-950">{{ $schoolProfile->name }}</h2>
                    @if(trim(strip_tags((string) $schoolProfile->description)) !== '')
                        <div class="prose prose-slate mt-5">{!! strip_tags($schoolProfile->description, $allowedHtml) !!}</div>
                    @endif
                    @if(trim(strip_tags((string) $schoolProfile->history)) !== '')
                        <div class="mt-10 border-t border-slate-200 pt-8">
                            <h3 class="text-xl font-extrabold text-brand-950">Sejarah</h3>
                            <div class="prose prose-slate mt-3">{!! strip_tags($schoolProfile->history, $allowedHtml) !!}</div>
                        </div>
                    @endif
                </div>
                <div class="space-y-5">
                    @if(trim(strip_tags((string) $schoolProfile->vision)) !== '')
                        <div class="border-l-4 border-brand-700 bg-brand-50 p-6">
                            <p class="site-eyebrow">Visi</p>
                            <div class="prose prose-slate mt-4">{!! strip_tags($schoolProfile->vision, $allowedHtml) !!}</div>
                        </div>
                    @endif
                    @if(trim(strip_tags((string) $schoolProfile->mission)) !== '')
                        <div class="border-l-4 border-brand-700 bg-white p-6 ring-1 ring-slate-200">
                            <p class="site-eyebrow">Misi</p>
                            <div class="prose prose-slate mt-4">{!! strip_tags($schoolProfile->mission, $allowedHtml) !!}</div>
                        </div>
                    @endif
                </div>
            </div>

            @if(trim(strip_tags((string) $schoolProfile->principal_greeting)) !== '' || $schoolProfile->principal_name || $schoolProfile->principal_photo)
                <div class="mt-14 border-t border-slate-200 pt-10">
                    <p class="site-eyebrow">Sambutan kepala sekolah</p>
                    <div class="mt-4 grid gap-8 md:grid-cols-[auto_1fr] md:items-start">
                        @if($schoolProfile->principal_photo)
                            <img src="{{ asset('storage/' . $schoolProfile->principal_photo) }}" alt="{{ $schoolProfile->principal_name ?: 'Kepala sekolah' }}" class="h-32 w-32 rounded-md object-cover">
                        @endif
                        <div>
                            @if($schoolProfile->principal_name)<h2 class="text-2xl font-extrabold text-brand-950">{{ $schoolProfile->principal_name }}</h2>@endif
                            @if(trim(strip_tags((string) $schoolProfile->principal_greeting)) !== '')<div class="prose prose-slate mt-4">{!! strip_tags($schoolProfile->principal_greeting, $allowedHtml) !!}</div>@endif
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="site-empty"><div class="site-empty-mark" aria-hidden="true">i</div><h2>Profil sekolah sedang disiapkan.</h2><p>Informasi profil sekolah akan ditampilkan setelah data diisi melalui panel admin.</p></div>
        @endif
    </section>
@endsection
