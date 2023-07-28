<?php
// app/Helpers/UploadHelper.php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadHelper
{
    public static function uploadProfilePicture(UploadedFile $file, $path, $name)
    {
        if (!$file->isValid()) {
            throw new \Exception('The profile picture is not valid.');
        }

        // Use Str::slug to replace spaces with underscores and remove illegal characters
        $extension = $file->getClientOriginalExtension();
        $profilePictureName = Str::slug($name) . '.' . $extension;

        // Create the directory if it doesn't exist
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0755, true);
        }

        // Move the uploaded file to the destination path
        $file->storeAs($path, $profilePictureName);

        return $path . $profilePictureName;
    }
}