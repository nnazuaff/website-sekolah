<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Juara 1 LKS Robotik Tingkat Nasional',
                'description' => 'Tim Robotik SMKN berhasil meraih medali emas dalam ajang Lomba Kompetensi Siswa (LKS) bidang Robotika tingkat Nasional.',
                'level' => 'Nasional',
                'achievement_date' => '2025-10-15',
                'year' => 2025,
                'photo' => null,
            ],
            [
                'title' => 'Juara 2 Olimpiade Matematika Terapan',
                'description' => 'Siswa atas nama Revi meraih juara 2 Olimpiade Matematika Terapan antar SMK se-Provinsi.',
                'level' => 'Provinsi',
                'achievement_date' => '2025-08-20',
                'year' => 2025,
                'photo' => null,
            ],
            [
                'title' => 'Medali Perunggu Web Technologies International',
                'description' => 'Perwakilan sekolah meraih medali perunggu pada kompetisi internasional bidang pengembangan web.',
                'level' => 'Internasional',
                'achievement_date' => '2026-02-10',
                'year' => 2026,
                'photo' => null,
            ],
            [
                'title' => 'Juara 1 Futsal Pelajar Kabupaten',
                'description' => 'Tim futsal sekolah meraih piala bergilir Turnamen Futsal Pelajar tingkat Kabupaten.',
                'level' => 'Kabupaten',
                'achievement_date' => '2026-05-12',
                'year' => 2026,
                'photo' => null,
            ],
        ];

        foreach ($achievements as $data) {
            Achievement::create($data);
        }
    }
}