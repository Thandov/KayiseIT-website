<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImagePathResolver
{
    /**
     * Resolve the correct image path, checking both original and optimized versions
     * Handles old paths like "images/gallery/..." and converts to new "gallery/..." structure
     * 
     * @param string $path Path stored in database
     * @return string Resolved path that exists
     */
    public static function resolve($path)
    {
        if (empty($path)) {
            return $path;
        }

        // Normalize old paths: convert "images/gallery/category/file.jpg" to "gallery/category/file.jpg"
        $normalizedPath = $path;
        if (strpos($path, 'images/gallery/') === 0) {
            $normalizedPath = str_replace('images/gallery/', 'gallery/', $path);
        }

        // Check if path already has _opt suffix
        if (strpos($normalizedPath, '_opt.') !== false) {
            $fullPath = storage_path('app/public/' . $normalizedPath);
            if (file_exists($fullPath)) {
                return $normalizedPath;
            }
        }

        // Try the normalized path first
        $fullPath = storage_path('app/public/' . $normalizedPath);
        if (file_exists($fullPath)) {
            return $normalizedPath;
        }

        // Try original path (for backward compatibility)
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            return $path;
        }

        // Try to find optimized version of normalized path
        $pathInfo = pathinfo($normalizedPath);
        $optimizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_opt.' . ($pathInfo['extension'] ?? 'jpg');
        $optimizedFullPath = storage_path('app/public/' . $optimizedPath);
        
        if (file_exists($optimizedFullPath)) {
            return $optimizedPath;
        }

        // Try optimized version of original path
        $pathInfo = pathinfo($path);
        $optimizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_opt.' . ($pathInfo['extension'] ?? 'jpg');
        $optimizedFullPath = storage_path('app/public/' . $optimizedPath);
        
        if (file_exists($optimizedFullPath)) {
            return $optimizedPath;
        }

        // Check legacy public/images/gallery location (for old files that weren't moved)
        $legacyPath = str_replace('images/gallery/', 'images/gallery/', $path);
        $legacyFullPath = public_path($legacyPath);
        if (file_exists($legacyFullPath)) {
            // Move it to the correct location for future requests
            $targetPath = storage_path('app/public/' . $normalizedPath);
            $targetDir = dirname($targetPath);
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            @copy($legacyFullPath, $targetPath);
            return $normalizedPath;
        }

        // Return normalized path (will try to load, may 404 if file doesn't exist)
        return $normalizedPath;
    }

    /**
     * Get asset URL for image, resolving path first
     * 
     * @param string $path Path stored in database
     * @return string Asset URL
     */
    public static function asset($path)
    {
        $resolvedPath = self::resolve($path);
        return asset('storage/' . $resolvedPath);
    }
}



