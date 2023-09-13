<?php

namespace Database\Factories;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MediaFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentPortfolio>
 */
class DocumentPortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function generateRandomHexColor()
    {
        $characters = '0123456789ABCDEF';
        $color = '';

        for ($i = 0; $i < 6; $i++) {
            $color .= $characters[random_int(0, 15)];
        }

        return $color;
    }

    public function definition(): array
    {

        $document_name = fake()->word();
        static $index = 0;
        $index = $index + 1;
        $folder_name = 'uploads/' . 'document' . '/' . $index;

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

            $file_path = $file_uploaded->id;

            return [
                'type_id' => mt_rand(1, 3),
                'title' => $document_name,
                'description' => fake()->text(),
                'file_path_1' => $folder_name . '/' . $fileName,
                'account_id' => 1,
                'portfolio_id' => $index,
            ];
        }
    }
}
