<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        \App\Models\Section::factory(6)->create();
    }
}
