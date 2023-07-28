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

        $extension = $file->getClientOriginalExtension();
        $profilePictureName = Str::slug($name) . '.' . $extension; // Use Str::slug to replace spaces with underscores

        $profilePicturePath = $profilePictureName;
        $file->storeAs($path, $profilePictureName);

        return $path . $profilePictureName;
    }
}