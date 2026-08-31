<?php

use App\Models\SchoolProfile;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('homepage presents school profile and active teachers', function () {
    SchoolProfile::create([
        'name' => 'SMK Nusantara',
        'description' => 'Sekolah vokasi yang menyiapkan generasi unggul.',
    ]);

    Teacher::create([
        'name' => 'Budi Santoso',
        'nip' => '1234567890',
        'position' => 'Guru',
        'subject' => 'Pemrograman',
        'is_active' => true,
    ]);

    Teacher::create([
        'name' => 'Guru Tidak Aktif',
        'nip' => '0987654321',
        'position' => 'Guru',
        'subject' => 'Jaringan',
        'is_active' => false,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('SMK Nusantara')
        ->assertSee('Budi Santoso')
        ->assertDontSee('Guru Tidak Aktif');
});

test('school profile page presents the first profile details', function () {
    SchoolProfile::create([
        'name' => 'SMK Nusantara',
        'description' => 'Tentang sekolah kami.',
        'history' => 'Berdiri sejak tahun 1990.',
        'vision' => 'Menjadi sekolah unggul.',
        'mission' => 'Mendidik dengan integritas.',
        'principal_name' => 'Siti Aminah',
        'principal_greeting' => 'Selamat datang di sekolah kami.',
    ]);

    $this->get(route('school-profile.index'))
        ->assertOk()
        ->assertSee('SMK Nusantara')
        ->assertSee('Berdiri sejak tahun 1990.')
        ->assertSee('Menjadi sekolah unggul.')
        ->assertSee('Siti Aminah');
});

test('contact page presents contact details and maps only when address exists', function () {
    SchoolProfile::create([
        'name' => 'SMK Nusantara',
        'address' => 'Jl. Pendidikan No. 1, Bandung',
        'phone' => '022-1234567',
        'email' => 'info@smknusantara.sch.id',
    ]);

    $this->get(route('contact.index'))
        ->assertOk()
        ->assertSee('Jl. Pendidikan No. 1, Bandung')
        ->assertSee('022-1234567')
        ->assertSee('info@smknusantara.sch.id')
        ->assertSee('Google Maps');
});

test('public pages render graceful empty states without a profile', function () {
    $this->get(route('home'))->assertOk()->assertSee('Informasi sekolah sedang disiapkan.');
    $this->get(route('school-profile.index'))->assertOk()->assertSee('Profil sekolah sedang disiapkan.');
    $this->get(route('contact.index'))->assertOk()->assertSee('Informasi kontak sedang disiapkan.');
});
