<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\File;

class UserFolderHelper
{
    /**
     * Create a user folder based on opportunity type and user information
     *
     * @param User $user
     * @param string $opportunityType (internship, training, tvet_placement)
     * @return string The folder path
     */
    public static function createUserFolder(User $user, string $opportunityType = 'general'): string
    {
        // Generate folder name: {userid_NameSurname}
        $folderName = self::generateFolderName($user);
        
        // Determine base path based on opportunity type
        $basePath = self::getBasePath($opportunityType);
        
        // Create full folder path
        $folderPath = public_path($basePath . '/' . $folderName);
        
        // Create directory if it doesn't exist
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }
        
        return $basePath . '/' . $folderName;
    }
    
    /**
     * Generate folder name using user ID, name, and surname
     *
     * @param User $user
     * @return string
     */
    public static function generateFolderName(User $user): string
    {
        $name = str_replace(' ', '_', $user->name ?? '');
        $surname = str_replace(' ', '_', $user->surname ?? '');
        
        // Clean the names to remove special characters that might cause issues
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
        $surname = preg_replace('/[^a-zA-Z0-9_-]/', '', $surname);
        
        // Combine user ID, name, and surname
        $folderName = $user->id . '_' . $name;
        
        if (!empty($surname)) {
            $folderName .= '_' . $surname;
        }
        
        return $folderName;
    }
    
    /**
     * Get the base path for different opportunity types
     *
     * @param string $opportunityType
     * @return string
     */
    public static function getBasePath(string $opportunityType): string
    {
        switch (strtolower($opportunityType)) {
            case 'internship':
                return 'Internships';
            case 'training':
                return 'Training';
            case 'tvet_placement':
                return 'TVET_Placements';
            default:
                return 'User_Files';
        }
    }
    
    /**
     * Get user folder path if it exists
     *
     * @param User $user
     * @param string $opportunityType
     * @return string|null
     */
    public static function getUserFolderPath(User $user, string $opportunityType = 'general'): ?string
    {
        $folderName = self::generateFolderName($user);
        $basePath = self::getBasePath($opportunityType);
        $fullPath = public_path($basePath . '/' . $folderName);
        
        return File::exists($fullPath) ? $basePath . '/' . $folderName : null;
    }
    
    /**
     * Store file in user's folder
     *
     * @param User $user
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $fileName
     * @param string $opportunityType
     * @return string File path
     */
    public static function storeUserFile(User $user, $file, string $fileName, string $opportunityType = 'general'): string
    {
        $folderPath = self::createUserFolder($user, $opportunityType);
        $fullFolderPath = public_path($folderPath);
        
        // Ensure folder exists
        if (!File::exists($fullFolderPath)) {
            File::makeDirectory($fullFolderPath, 0755, true);
        }
        
        // Store the file
        $storedPath = $folderPath . '/' . $fileName;
        $file->storeAs($folderPath, $fileName, 'public');
        
        return $storedPath;
    }
}





