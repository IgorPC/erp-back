<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileStorageService
{
    public function saveFile($base64, $mimeType, $path, $filename)
    {
        $file = str_replace("data:{$mimeType};base64,", "", $base64);
        $file = base64_decode($file);

        $type = str_replace("image/", "",$mimeType);

        $filePath = $path."/".$filename.".".$type;
        Storage::disk('public')->put($filePath, $file);

        return $filePath;
    }
}
