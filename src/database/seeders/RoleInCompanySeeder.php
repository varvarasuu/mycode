<?php

namespace Database\Seeders;

use App\Models\RoleInCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleInCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleInCompany::create([
            'name' => 'Администратор'
        ]);

        RoleInCompany::create([
            'name' => 'Менеджер  с правами администратора'
        ]);

        RoleInCompany::create([
            'name' => 'Менеджер'
        ]);
    }
}
