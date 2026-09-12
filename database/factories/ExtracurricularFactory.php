<?php

namespace Database\Factories;

use App\Models\Extracurricular;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Extracurricular>
 */
class ExtracurricularFactory extends Factory
{
    protected $model = Extracurricular::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Pramuka', 'Paskibra', 'PMR', 'Basket', 'Badminton', 'Perisai Diri']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(2),
            'coach' => fake()->name(),
            'schedule' => fake()->randomElement(['Senin dan Rabu, 15.30-17.00', 'Selasa dan Kamis, 15.30-17.00', 'Sabtu, 07.00-12.00']),
            'photo' => null,
            'is_active' => true,
        ];
    }
}
