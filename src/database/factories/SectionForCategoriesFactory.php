<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SectionForCategories>
 */
class SectionForCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = [
            'Я заказчик',
            'Я исполнитель',
            'Я работодатель',
            'Я соискатель',
            'Я продавец',
            'Я покупатель',
        ];

        static $index = -1;
        $index = $index + 1;
        return [
            'title' => $title[$index],
        ];
    }
}
