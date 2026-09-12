<?php

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the public teacher page uses the public layout and lists active teachers only', function () {
    Teacher::create([
        'name' => 'Guru Aktif',
        'nip' => '1234567890',
        'position' => 'Guru',
        'subject' => 'Pemrograman',
        'is_active' => true,
    ]);

    Teacher::create([
        'name' => 'Guru Nonaktif',
        'nip' => '0987654321',
        'position' => 'Guru',
        'subject' => 'Jaringan',
        'is_active' => false,
    ]);

    $response = $this->get(route('teachers.index'));

    $response
        ->assertOk()
        ->assertSee('Portal sekolah')
        ->assertSee('Guru Aktif')
        ->assertDontSee('Guru Nonaktif');
});
