<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()
            ->count(2)
            ->create()
            ->each(function (Course $course): void {
                Video::factory()
                    ->count(fake()->numberBetween(3, 6))
                    ->create([
                        'course_id' => $course->id,
                    ]);
            });
    }
}
