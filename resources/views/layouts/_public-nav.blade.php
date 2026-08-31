@php($mobile = $mobile ?? false)
@php($items = [
    ['route' => 'home', 'label' => 'Beranda', 'active' => request()->routeIs('home')],
    ['route' => 'school-profile.index', 'label' => 'Profil', 'active' => request()->routeIs('school-profile.*')],
    ['route' => 'majors.index', 'label' => 'Jurusan', 'active' => request()->routeIs('majors.*')],
    ['route' => 'teachers.index', 'label' => 'Guru', 'active' => request()->routeIs('teachers.*')],
    ['route' => 'news.index', 'label' => 'Berita', 'active' => request()->routeIs('news.*')],
    ['route' => 'pengumuman.index', 'label' => 'Pengumuman', 'active' => request()->routeIs('pengumuman.*')],
    ['route' => 'galeri.index', 'label' => 'Galeri', 'active' => request()->routeIs('galeri.*')],
    ['route' => 'fasilitas.index', 'label' => 'Fasilitas', 'active' => request()->routeIs('fasilitas.*')],
    ['route' => 'contact.index', 'label' => 'Kontak', 'active' => request()->routeIs('contact.*')],
])
@foreach($items as $item)
    <a href="{{ route($item['route']) }}" @class(['nav-link', 'nav-link-mobile' => $mobile, 'is-active' => $item['active']]) @if($item['active']) aria-current="page" @endif>{{ $item['label'] }}</a>
@endforeach
