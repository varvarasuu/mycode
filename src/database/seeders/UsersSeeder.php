<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use App\Services\Api\Chat\Services\ChatUserService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'The best',
            'lastname' => 'Project',
            'region_id' => '1',
            'gender_id' => '1',
            'account_id' => '1'
        ]);

        User::create([
            'name' => 'Danilo',
            'lastname' => 'Mercado',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '2'
        ]);

        User::create([
            'name' => 'Varvara',
            'lastname' => 'Sumenkova',
            'region_id' => '2',
            'gender_id' => '2',
            'account_id' => '3'
        ]);

        User::create([
            'name' => 'Jorge',
            'lastname' => 'Lopez',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '4'
        ]);

        User::create([
            'name' => 'Timur',
            'lastname' => 'akchl1',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '5'
        ]);

        User::create([
            'name' => 'Pavel',
            'lastname' => 'Pavel',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '6'
        ]);

        User::create([
            'name' => 'Viktor',
            'lastname' => 'Marandin',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '7'
        ]);

        User::create([
            'name' => 'Nikita',
            'lastname' => 'Nikita',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '8'
        ]);

        User::create([
            'name' => 'Anatoli',
            'lastname' => 'Anatoli',
            'region_id' => '2',
            'gender_id' => '1',
            'account_id' => '9'
        ]);
    //    $this->seed_chat();
    }

    public function seed_chat(){
        $chat_user_service = new ChatUserService(Account::find(1), User::find(1));
        for($i = 1; $i <= 9; $i ++){
            $chat_user_service->setData(Account::find($i), User::find($i));
            $chat_user_service->createUser();
        }
    }
}
