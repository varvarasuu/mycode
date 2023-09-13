<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\MediaFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Accounts for dev team

        Account::create([
            'email' => 'test@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+79817569728',
            'avatar' => $this->generateImage('uploads/avatars')
        ]);

        Account::create([
            'email' => 'da@gmail.com',
            'password' => Hash::make("Hz1_`{|}~.3'"),
            'phone_number' => '+79817569720',
            'avatar' => $this->generateImage('uploads/avatars')
        ]);

        Account::create([
            'email' => 'sumenkova.va@gmail.com',
            'password' => Hash::make('WorkWork222@@@'),
            'phone_number' => '+79112847343',
        ]);

        Account::create([
            'email' => 'the.george.747@gmail.com',
            'password' => Hash::make('AtW0rk##.jlk'),
            'phone_number' => '+79643988282',
        ]);

        Account::create([
            'email' => 'walox13@mail.ru',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+79818462208',
        ]);

        Account::create([
            'email' => 'avdeev.pavel2018@yandex.ru',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+79312474696',
        ]);

        Account::create([
            'email' => 'marandin@pro.pro',
            'password' => Hash::make('Marandin_12345'),
            'phone_number' => '+79000000000',
        ]);

        Account::create([
            'email' => 'nekid159@yandex.ru',
            'password' => Hash::make('Dd17549dd!'),
            'phone_number' => '+79191640883',
        ]);

        Account::create([
            'email' => 'anatolii_nov@mail.ru',
            'password' => Hash::make('ExMWqX00'),
            'phone_number' => '+79000000001',
        ]);

        // Accounts for companies

        Account::create([
            'email' => '7804679272@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+347804679272',
        ]);

        Account::create([
            'email' => '7717756611@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+347717756611',
        ]);

        Account::create([
            'email' => '5027068206@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+345027068206',
        ]);
        Account::create([
            'email' => '5263038941@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+345263038941',
        ]);
        Account::create([
            'email' => '7609016017@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+347609016017',
        ]);
        Account::create([
            'email' => '7744000126@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+347744000126',
        ]);
        Account::create([
            'email' => '2540274779@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+342540274779',
        ]);
        Account::create([
            'email' => '7604392829@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+347604392829',
        ]);
        Account::create([
            'email' => '0326567370@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+340326567370',
        ]);
        Account::create([
            'email' => '0326577756@at-work.pro',
            'password' => Hash::make('AtW0rk##'),
            'phone_number' => '+340326577756',
        ]);
    }

    public function generateRandomHexColor()
    {
        $characters = '0123456789ABCDEF';
        $color = '';

        for ($i = 0; $i < 6; $i++) {
            $color .= $characters[random_int(0, 15)];
        }

        return $color;
    }

    public function generateImage($folder_name)
    {
        $response = Http::get("https://placehold.jp/" . $this->generateRandomHexColor() . "/ffffff/150x150.png");

        if ($response->successful()) {
            $imageContent = $response->body();
            $fileName = Str::uuid()->toString() . '.png';

            $storagePath = storage_path('app/public/' . $folder_name);
            if (!is_dir($storagePath)) {
                mkdir($storagePath, 0777, true);
            }
            $filePath = $storagePath . '/' . $fileName;
            file_put_contents($filePath, $imageContent);

            $fileSize = strlen($imageContent);
            $mimeType = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $imageContent);

            $file_uploaded = MediaFile::create([
                'file_name' => $fileName,
                'file_path' => $folder_name . '/' . $fileName,
                'file_type' => $mimeType,
                'file_size' => $fileSize,
            ]);

            return $file_uploaded->id;
        }
    }
}
