<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HelpCategory>
 */
class HelpCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = [
            '',
            '',
            ''
        ];

        static $index = -1;
        $index = $index + 1;

        return [
            //
        ];
    }
}
