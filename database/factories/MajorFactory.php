<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Major>
 */
class MajorFactory extends Factory
{
    protected $model = Major::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Rekayasa Perangkat Lunak',
            'Teknik Elektronika Industri',
            'Teknik Instalasi Tenaga Listrik',
            'Teknik Kendaraan Ringan Otomotif',
            'Teknik dan Bisnis Sepeda Motor',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'short_name' => fake()->randomElement(['RPL', 'TEI', 'TITL', 'TKRO', 'TBSM']),
            'description' => fake()->paragraph(3),
            'image' => null,
            'is_active' => true,
        ];
    }
}
