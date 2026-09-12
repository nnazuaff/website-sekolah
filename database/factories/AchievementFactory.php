<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Achievement>
 */
class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Juara 1 LKS Tingkat Kabupaten Bandung',
                'Juara 1 LKS Tingkat Provinsi Jawa Barat',
                'Finalis Kompetisi Keahlian Siswa',
                'Juara Lomba Pramuka Tingkat Kabupaten',
            ]),
            'description' => fake()->paragraph(2),
            'level' => fake()->randomElement(['Kabupaten', 'Provinsi', 'Nasional']),
            'achievement_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'year' => fake()->numberBetween(2024, 2026),
            'photo' => null,
        ];
    }
}
