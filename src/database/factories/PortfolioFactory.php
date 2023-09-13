<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        static $index = 0;
        $index = $index + 1;
        return [
        'name' => fake()->word(),
        'about' =>fake()->text(),
        'link' => fake()->imageUrl(640, 480, 'abstract'),
        'account_id' => 1,
        'status' => "active",
        ];
    }
}
