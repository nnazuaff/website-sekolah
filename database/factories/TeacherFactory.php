<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Teacher>
 */
class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nip' => fake()->unique()->numerify('19##############'),
            'position' => fake()->randomElement(['Guru Produktif', 'Guru Mata Pelajaran', 'Wakil Kepala Sekolah']),
            'subject' => fake()->randomElement(['Rekayasa Perangkat Lunak', 'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Dasar-Dasar Kejuruan']),
            'photo' => null,
            'description' => fake()->sentence(12),
            'is_active' => true,
        ];
    }
}
