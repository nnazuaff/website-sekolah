@php($mobile = $mobile ?? false)
@php($groups = [
    ['label' => 'Profil', 'active' => request()->routeIs('school-profile.*', 'contact.*'), 'items' => [['route' => 'school-profile.index', 'label' => 'Profil sekolah', 'pattern' => 'school-profile.*'], ['route' => 'contact.index', 'label' => 'Kontak', 'pattern' => 'contact.*']]],
    ['label' => 'Akademik', 'active' => request()->routeIs('majors.*', 'teachers.*'), 'items' => [['route' => 'majors.index', 'label' => 'Program keahlian', 'pattern' => 'majors.*'], ['route' => 'teachers.index', 'label' => 'Guru dan tendik', 'pattern' => 'teachers.*']]],
    ['label' => 'Informasi', 'active' => request()->routeIs('news.*', 'pengumuman.*', 'achievements.*'), 'items' => [['route' => 'news.index', 'label' => 'Berita', 'pattern' => 'news.*'], ['route' => 'pengumuman.index', 'label' => 'Pengumuman', 'pattern' => 'pengumuman.*'], ['route' => 'achievements.index', 'label' => 'Prestasi', 'pattern' => 'achievements.*']]],
    ['label' => 'Media', 'active' => request()->routeIs('extracurriculars.*', 'fasilitas.*', 'galeri.*'), 'items' => [['route' => 'extracurriculars.index', 'label' => 'Ekstrakurikuler', 'pattern' => 'extracurriculars.*'], ['route' => 'fasilitas.index', 'label' => 'Fasilitas', 'pattern' => 'fasilitas.*'], ['route' => 'galeri.index', 'label' => 'Galeri', 'pattern' => 'galeri.*']]],
])
@if ($mobile)
    <a href="{{ route('home') }}" @class(['mobile-nav-link', 'is-active' => request()->routeIs('home')])>Beranda</a>
    @foreach ($groups as $group)
        <details class="mobile-nav-dropdown" @if($group['active']) open @endif>
            <summary @class(['mobile-nav-link', 'is-active' => $group['active']])>{{ $group['label'] }} <span aria-hidden="true">⌄</span></summary>
            <div>@foreach ($group['items'] as $item)<a @class(['is-current' => request()->routeIs($item['pattern'])]) href="{{ route($item['route']) }}">{{ $item['label'] }}</a>@endforeach</div>
        </details>
    @endforeach
@else
    <a href="{{ route('home') }}" @class(['nav-link', 'is-active' => request()->routeIs('home')]) @if(request()->routeIs('home')) aria-current="page" @endif>Beranda</a>
    @foreach ($groups as $group)
        <details class="nav-dropdown" @if($group['active']) open @endif>
            <summary @class(['nav-link', 'is-active' => $group['active']])>{{ $group['label'] }} <span aria-hidden="true">⌄</span></summary>
            <div class="nav-dropdown-panel">@foreach ($group['items'] as $item)<a @class(['is-current' => request()->routeIs($item['pattern'])]) @if(request()->routeIs($item['pattern'])) aria-current="page" @endif href="{{ route($item['route']) }}">{{ $item['label'] }}</a>@endforeach</div>
        </details>
    @endforeach
    <a href="{{ route('contact.index') }}" @class(['nav-cta', 'is-active' => request()->routeIs('contact.*')])>Hubungi sekolah</a>
@endif