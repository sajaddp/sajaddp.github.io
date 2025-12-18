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
        $faker = fake('fa_IR');
        $source = fake()->randomElement(VideoSource::cases());
        $youtubeUrl = sprintf('https://www.youtube.com/watch?v=%s', $faker->lexify('??????????'));
        $aparatUrl = sprintf('https://www.aparat.com/v/%s', $faker->lexify('???????'));

        return [
            'course_id' => \App\Models\Course::factory(),
            'source' => $source,
            'title' => $faker->sentence(4),
            'youtube_url' => $source === VideoSource::Aparat ? $aparatUrl : $youtubeUrl,
            'thumbnail_url' => $faker->imageUrl(1280, 720, 'education'),
            'body' => $faker->paragraphs(2, true),
            'attachment_path' => null,
        ];
    }
}
