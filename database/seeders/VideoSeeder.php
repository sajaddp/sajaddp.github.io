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

        collect(range(1, 10))->each(function () use ($courses): void {
            Video::factory()->create([
                'course_id' => $courses->random()->id,
            ]);
        });
    }
}
