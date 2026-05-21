<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'primary_department' => 2,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'user_status' => 'Active',
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('password'),
            'learning_style' => 1,
            'license' => 1,
            'created_at' => $this->faker->dateTimeBetween("-2 years", "now", "PST"),
            'updated_at' => $this->faker->dateTimeBetween("-1 years", "now", "PST"),
        ];
    }
}
