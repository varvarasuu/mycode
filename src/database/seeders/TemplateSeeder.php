<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DefaultTemplate;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all = DefaultTemplate::all();
        for ($i = 1; $i <= 10; $i++)
        {
            foreach($all as $default){
                Template::create(['company_id' => $i, "category" => $default->category, "name" => $default->name, "text" => $default->text]);
            }

        }
    }
}
