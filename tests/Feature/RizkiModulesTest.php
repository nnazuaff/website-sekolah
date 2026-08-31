<?php

use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

test('public gallery page lists gallery entries', function () {
    Gallery::create(['title' => 'Upacara Bendera', 'description' => 'Kegiatan sekolah', 'image' => null, 'taken_at' => '2026-08-01']);

    $this->get(route('galeri.index'))
        ->assertOk()
        ->assertSee('Upacara Bendera')
        ->assertSee('Galeri');
});

test('public facilities page shows active facilities only', function () {
    Facility::create(['name' => 'Laboratorium Komputer', 'slug' => 'laboratorium-komputer', 'description' => 'Lab', 'is_active' => true]);
    Facility::create(['name' => 'Ruang Lama', 'slug' => 'ruang-lama', 'description' => 'Tidak tampil', 'is_active' => false]);

    $this->get(route('fasilitas.index'))
        ->assertOk()
        ->assertSee('Laboratorium Komputer')
        ->assertDontSee('Ruang Lama');
});

test('public announcements hide inactive expired and future records', function () {
    Announcement::create(['title' => 'Aktif', 'slug' => 'aktif', 'content' => 'Konten aktif', 'published_at' => Carbon::now()->subDay(), 'expired_at' => Carbon::now()->addDay(), 'is_active' => true]);
    Announcement::create(['title' => 'Nonaktif', 'slug' => 'nonaktif', 'content' => 'Rahasia', 'published_at' => Carbon::now()->subDay(), 'is_active' => false]);
    Announcement::create(['title' => 'Kadaluarsa', 'slug' => 'kadaluarsa', 'content' => 'Rahasia', 'published_at' => Carbon::now()->subDays(2), 'expired_at' => Carbon::now()->subDay(), 'is_active' => true]);
    Announcement::create(['title' => 'Mendatang', 'slug' => 'mendatang', 'content' => 'Rahasia', 'published_at' => Carbon::now()->addDay(), 'is_active' => true]);

    $this->get(route('pengumuman.index'))
        ->assertOk()
        ->assertSee('Aktif')
        ->assertDontSee('Nonaktif')
        ->assertDontSee('Kadaluarsa')
        ->assertDontSee('Mendatang');

    $this->get(route('pengumuman.show', 'aktif'))->assertOk()->assertSee('Konten aktif');
    $this->get(route('pengumuman.show', 'nonaktif'))->assertNotFound();
});
