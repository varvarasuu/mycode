<?php

namespace App\Services\Api\MediaFile;

use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class MediaFileService
{

    // use HttpResponse;

    protected Request $request;

    function __construct()
    {
        $this->request = Request();
    }

    public function upload(UploadedFile $file, $path): MediaFile
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = Str::uuid()->toString() . '.' . $fileExtension;

        $file->storeAs('public/' . $path, $fileName);

        return MediaFile::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path . '/' . $fileName,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);
    }

    private function replaceFileInStorage(MediaFile $file, UploadedFile $newFile, $path): void
    {
        Storage::delete('public/' . $file->file_path);
        $fileExtension = $newFile->getClientOriginalExtension();
        $fileName = Str::uuid()->toString() . '.' . $fileExtension;
        $newFile->storeAs('public/' . $path, $fileName);
        $file->update([
            'file_name' => $newFile->getClientOriginalName(),
            'file_path' => $path . '/' . $fileName,
            'file_type' => $newFile->getClientMimeType(),
            'file_size' => $newFile->getSize(),
        ]);
    }

    public function storeOne(UploadedFile $file, $path): MediaFile
    {
        return $this->upload($file, $path);
    }

    public function storeMultiple(array $files, $path): array
    {
        $uploadedFiles = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $uploadedFiles[] = $this->upload($file, $path);
            }
        }

        return $uploadedFiles;
    }

    public function update($id, UploadedFile $new_file, $path): MediaFile
    {
        $file = MediaFile::find($id);
        if (!$file) {
            if (isset($new_file) && $new_file instanceof UploadedFile) {
                $file = $this->upload($new_file, $path);
            }
        } else {
            if (isset($new_file)) {
                $this->replaceFileInStorage($file, $new_file, $path);
            }
        }

        return $file;
    }

    public function getImagePathAndFileName($id): ?string
    {
        if ($id == null) {
            return null;
        }
        $file = MediaFile::find($id);

        if ($file) {
            $url = asset('storage/' . $file->file_path);
            $parsedUrl = parse_url($url);

            if (isset($parsedUrl['path'])) {
                return $parsedUrl['path'];
            }
        }

        return null;
    }

    public function delete(int $id): bool
    {
        $file = MediaFile::find($id);

        if ($file) {
            $file->delete();

            Storage::delete('public/' . $file->file_path);

            return true;
        }

        return false;
    }
}
