<?php

namespace Database\Seeders;

use App\Models\CompanySize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanySize::create([
            'size' => '1 человек'
        ]);

        CompanySize::create([
            'size' => 'до 10 человек'
        ]);

        CompanySize::create([
            'size' => 'от 10 до 100 человек'
        ]);

        CompanySize::create([
            'size' => 'от 100 до 1000 человек'
        ]);

        CompanySize::create([
            'size' => 'от 1000 до 5000 человек'
        ]);

        CompanySize::create([
            'size' => 'более 5000 человек'
        ]);
    }
}
