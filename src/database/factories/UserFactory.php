<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'role' => 2,
            'user_status' => 'Active',
            'username' => $this->faker->unique()->userName,
            'password' => $this->faker->password,
            'learning_style' => 1,
            'license' => 1,
            'created_at' => $this->faker->dateTimeBetween("-2 years", "now", "PST"),
            'updated_at' => $this->faker->dateTimeBetween("-1 years", "now", "PST"),
        ];
    }
}
