<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        return [
            'title' => fake()->randomElement(['Kegiatan Pembelajaran', 'Upacara Bendera', 'Kegiatan Pramuka', 'Kompetisi Siswa', 'Lingkungan Sekolah']),
            'description' => fake()->sentence(14),
            'image' => null,
            'taken_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
