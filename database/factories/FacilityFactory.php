<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Facility>
 */
class FacilityFactory extends Factory
{
    protected $model = Facility::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Laboratorium Komputer', 'Perpustakaan', 'Bengkel Praktik', 'Lapangan Olahraga', 'Ruang Kelas']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(2),
            'photo' => null,
            'is_active' => true,
        ];
    }
}
