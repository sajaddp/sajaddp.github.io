<?php

namespace Database\Factories;

use App\VideoSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => \App\Models\Course::factory(),
            'source' => fake()->randomElement(VideoSource::cases()),
            'title' => fake()->sentence(4),
            'youtube_url' => fake()->url(),
            'thumbnail_url' => fake()->imageUrl(1280, 720, 'education'),
            'body' => fake()->paragraphs(2, true),
            'attachment_path' => null,
        ];
    }
}
