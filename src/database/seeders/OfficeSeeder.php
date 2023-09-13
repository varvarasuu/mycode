<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::create(["company_id" => 1,
                                        "address" => "Санкт-Петербург, Гражданский проспект, 22",
                                        "account_id" => 1
                                    ]);
        Office::create(["company_id" => 2,
                                    "address" => "Санкт-Петербург, Гражданский проспект, 23",
                                    "account_id" => 1
                                ]);
        Office::create(["company_id" => 3,
                                "address" => "Санкт-Петербург, Гражданский проспект, 24",
                                "account_id" => 1
                            ]);


    }
}
