<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('fa_IR');

        return [
            'title' => $faker->sentence(3),
            'description' => $faker->paragraph(),
            'body' => $faker->paragraphs(3, true),
        ];
    }
}
