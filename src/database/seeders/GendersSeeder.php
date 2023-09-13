<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::create(['id' => '1', 'name' => 'Мужской']);
        Gender::create(['id' => '2', 'name' => 'Женский']);
    }
}
