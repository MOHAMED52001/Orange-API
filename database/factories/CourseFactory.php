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
    public function definition()
    {
        return [
            'title' => fake()->jobTitle(),
            'headline' => fake()->realText(20),
            'type' => rand(0, 1),
            'technologies' => fake()->realText(10),
            'description' => fake()->realText(200),
            'duration' => "3 months",
            'instructor_id' => rand(1, 700),
        ];
    }
}
