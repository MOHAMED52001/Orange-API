<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
                'fname' => 'ODC',
                'lname' => 'ODC',
                'email' => 'ODCadmin@orange.com',
                'national_id' => "3010541545266aa",
                'phone' => "0218a203a5453",
                'password' => $password,
                'role_id' => Role::SUPER_ADMIN
            ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}