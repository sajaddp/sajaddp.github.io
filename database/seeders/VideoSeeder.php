<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::query()->get();

        if ($courses->isEmpty()) {
            $courses = Course::factory()->count(2)->create();
        }

        $courses->each(function (Course $course): void {
            Video::factory()->count(3)->create([
                'course_id' => $course->id,
            ]);
        });
    }
}
