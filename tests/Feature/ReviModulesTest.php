<?php

use App\Models\Achievement;
use App\Models\Extracurricular;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public achievement page displays achievement details and photo', function () {
    Achievement::create([
        'title' => 'Juara Olimpiade Sains',
        'description' => 'Meraih juara pertama tingkat kabupaten.',
        'level' => 'Kabupaten',
        'achievement_date' => '2026-08-20',
        'year' => 2026,
        'photo' => 'achievements/olimpiade.jpg',
    ]);

    $response = $this->get(route('achievements.index'));

    $response
        ->assertOk()
        ->assertViewIs('public.achievements.index')
        ->assertSee('Juara Olimpiade Sains')
        ->assertSee('Kabupaten')
        ->assertSee('2026')
        ->assertSee('Meraih juara pertama tingkat kabupaten.')
        ->assertSee('storage/achievements/olimpiade.jpg');
});

test('public extracurricular page displays active records only', function () {
    Extracurricular::create([
        'name' => 'Pramuka',
        'slug' => 'pramuka',
        'description' => 'Kegiatan kepanduan sekolah.',
        'coach' => 'Bapak Pembina',
        'schedule' => 'Jumat, 14.00 WIB',
        'photo' => 'extracurriculars/pramuka.jpg',
        'is_active' => true,
    ]);

    Extracurricular::create([
        'name' => 'Klub Nonaktif',
        'slug' => 'klub-nonaktif',
        'description' => 'Tidak ditampilkan.',
        'coach' => 'Pembina',
        'schedule' => 'Senin',
        'is_active' => false,
    ]);

    $response = $this->get(route('extracurriculars.index'));

    $response
        ->assertOk()
        ->assertViewIs('public.extracurriculars.index')
        ->assertSee('Pramuka')
        ->assertSee('Bapak Pembina')
        ->assertSee('Jumat, 14.00 WIB')
        ->assertDontSee('Klub Nonaktif');
});
