<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Help>
 */
class HelpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "cat_id" => 1,
            "title" => fake()->text(17),
            "content" => fake()->text(370),
            "principal_iamge" => 'https://thispersondoesnotexist.com/',

        ];
    }
}
