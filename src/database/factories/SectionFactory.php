<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
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
            'Я покупатель',
            'Я продавец',
        ];

        $title_in_privacy = [
            'Мои заказы',
            'Мое портфолио',
            'Мои вакансии',
            'Мои объявления о покупке',
            'Мои объявления о продаже',
            'Мои лоты',
            'Мои тендеры',
        ];

        $title_all_privacy = [
            'Все исполнители',
            'Все заказчики',
            'Все работодатели',
            'Все продавцы',
            'Все покупатели',
            'Все пользователи',
        ];

        $can_company = [
            1,1,1,0,1,1
        ];

        $can_user = [
            1,1,0,1,1,1
        ];

        static $index = -1;
        $index = $index + 1;
        return [
            'title' => $title[$index],
            'title_in_privacy' => $title_in_privacy[$index],
            'title_all_privacy' => $title_all_privacy[$index],
            'title_only_me' => 'Только я',
            'can_company' => $can_company[$index],
            'can_user' => $can_user[$index]
        ];
    }
}
