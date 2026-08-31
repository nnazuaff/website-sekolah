<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        $title = fake()->sentence(7);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 9999),
            'content' => fake()->paragraphs(3, true),
            'published_at' => fake()->dateTimeBetween('-2 months', '-1 day'),
            'expired_at' => null,
            'is_active' => true,
        ];
    }

    public function draft(): static
    {
        return $this->state(fn () => [
            'published_at' => fake()->dateTimeBetween('+1 day', '+1 month'),
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn () => [
            'expired_at' => fake()->dateTimeBetween('-1 month', '-1 day'),
        ]);
    }
}
