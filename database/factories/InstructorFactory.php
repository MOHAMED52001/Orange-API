<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $password = bcrypt("1234");

        return
            [
                'fname' => fake()->firstName(),
                'lname' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'national_id' => fake()->unique()->text(20),
                'phone' => fake()->unique()->phoneNumber(),
                'password' => $password,
                'role_id' => Role::Instructor
            ];
    }
}