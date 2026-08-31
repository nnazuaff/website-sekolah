<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Major;
use App\Models\News;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::query()->doesntExist()) {
            User::factory()->create([
                'name' => 'Admin Demo',
                'email' => 'test@example.com',
            ]);
        }

        if (SchoolProfile::query()->doesntExist()) {
            SchoolProfile::factory()->create();
        }

        if (Teacher::query()->doesntExist()) {
            Teacher::factory()->count(12)->create();
        }

        if (Major::query()->doesntExist()) {
            Major::factory()->count(5)->create();
        }

        if (News::query()->doesntExist()) {
            News::factory()->count(8)->create();
        }

        if (Achievement::query()->doesntExist()) {
            Achievement::factory()->count(8)->create();
        }

        if (Extracurricular::query()->doesntExist()) {
            Extracurricular::factory()->count(6)->create();
        }

        if (Gallery::query()->doesntExist()) {
            Gallery::factory()->count(10)->create();
        }

        if (Facility::query()->doesntExist()) {
            Facility::factory()->count(5)->create();
        }

        if (Announcement::query()->doesntExist()) {
            Announcement::factory()->count(5)->create();
        }
    }
}
