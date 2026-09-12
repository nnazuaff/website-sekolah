<?php

use App\Models\Major;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public major pages show active majors and resolve the slug detail', function () {
    $activeMajor = Major::create([
        'name' => 'Rekayasa Perangkat Lunak',
        'slug' => 'rekayasa-perangkat-lunak',
        'short_name' => 'RPL',
        'description' => 'Belajar membangun perangkat lunak.',
        'is_active' => true,
    ]);

    Major::create([
        'name' => 'Major Tidak Aktif',
        'slug' => 'major-tidak-aktif',
        'short_name' => 'MTA',
        'description' => 'Tidak ditampilkan.',
        'is_active' => false,
    ]);

    $indexResponse = $this->get(route('majors.index'));

    $indexResponse
        ->assertOk()
        ->assertViewIs('public.majors.index')
        ->assertSee($activeMajor->name)
        ->assertDontSee('Major Tidak Aktif');

    $this->get(route('majors.show', $activeMajor->slug))
        ->assertOk()
        ->assertViewIs('public.majors.show')
        ->assertSee($activeMajor->name)
        ->assertSee($activeMajor->description);
});

test('public news pages show only published news that is not in the future', function () {
    News::create([
        'title' => 'Berita Terbit',
        'slug' => 'berita-terbit',
        'excerpt' => 'Ringkasan berita terbit.',
        'content' => 'Isi berita terbit.',
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);

    News::create([
        'title' => 'Berita Draft',
        'slug' => 'berita-draft',
        'excerpt' => 'Tidak tampil.',
        'content' => 'Isi draft.',
        'status' => 'draft',
        'published_at' => now()->subDay(),
    ]);

    News::create([
        'title' => 'Berita Masa Depan',
        'slug' => 'berita-masa-depan',
        'excerpt' => 'Belum tampil.',
        'content' => 'Isi masa depan.',
        'status' => 'published',
        'published_at' => now()->addDay(),
    ]);

    News::create([
        'title' => 'Berita Arsip',
        'slug' => 'berita-arsip',
        'excerpt' => 'Sudah diarsipkan.',
        'content' => 'Isi arsip.',
        'status' => 'archived',
        'published_at' => now()->subDay(),
    ]);

    $this->get(route('news.index'))
        ->assertOk()
        ->assertViewIs('public.news.index')
        ->assertSee('Berita Terbit')
        ->assertDontSee('Berita Draft')
        ->assertDontSee('Berita Masa Depan')
        ->assertDontSee('Berita Arsip');

    $this->get(route('news.show', 'berita-terbit'))
        ->assertOk()
        ->assertViewIs('public.news.show')
        ->assertSee('Isi berita terbit.');

    $this->get(route('news.show', 'berita-draft'))->assertNotFound();
});
