<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaidCatalog;

class PaidCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creator[] = [
            'name' => 'Сервисы',
            'url' => 'services'
        ];
        $creator[] = [
            'name' => 'Прайс-лист - Я соискатель',
            'url' => 'priceListJobSeeker'
        ];
        $creator[] = [
            'name' => 'Прайс-лист - Я соискатель',
            'url' => 'priceListEmployer'
        ];
        foreach ($creator as $creat)
        {
            PaidCatalog::create($creat);
        }
    }
}
