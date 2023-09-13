<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfficeMetro;

class OfficeMetroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfficeMetro::create(['office_id' => 1, 'metro_id' => 1]);
        OfficeMetro::create(['office_id' => 1, 'metro_id' => 2]);
        OfficeMetro::create(['office_id' => 1, 'metro_id' => 3]);

        OfficeMetro::create(['office_id' => 2, 'metro_id' => 4]);
        OfficeMetro::create(['office_id' => 2, 'metro_id' => 5]);
        

        OfficeMetro::create(['office_id' => 3, 'metro_id' => 6]);
        OfficeMetro::create(['office_id' => 3, 'metro_id' => 7]);
        OfficeMetro::create(['office_id' => 3, 'metro_id' => 8]);
        OfficeMetro::create(['office_id' => 3, 'metro_id' => 9]);
        OfficeMetro::create(['office_id' => 3, 'metro_id' => 10]);

    }
}
