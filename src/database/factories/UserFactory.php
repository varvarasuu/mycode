<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'lastname' => fake()->lastName(),
            'account_id' => mt_rand(1, 10),
            'region_id' => 1,
            'gender_id' => mt_rand(1, 2),
            'birthday' => fake()->date(),
            'balance' => 0,
        ];
    }
}
