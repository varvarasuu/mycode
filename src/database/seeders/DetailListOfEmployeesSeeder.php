<?php

namespace Database\Seeders;

use App\Models\DetailListOfEmployees;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailListOfEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailListOfEmployees::create([
            'employee_id' => 1,
            'list_of_employees_id' => 1,
            'role_in_company_id' => 1
        ]);

        DetailListOfEmployees::create([
            'employee_id' => 1,
            'list_of_employees_id' => 2,
            'role_in_company_id' => 1
        ]);

        DetailListOfEmployees::create([
            'employee_id' => 1,
            'list_of_employees_id' => 3,
            'role_in_company_id' => 1
        ]);
    }
}
