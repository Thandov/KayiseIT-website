<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageOptimizer
{
    /**
     * Optimize image for web use
     * 
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $storagePath Path where image should be stored (relative to storage/app/public)
     * @param array $options Optimization options
     * @return string Path to optimized image (relative to storage/app/public)
     */
    public static function optimize($image, $storagePath, $options = [])
    {
        // Default options
        $maxWidth = $options['max_width'] ?? 1920; // Max width for web
        $maxHeight = $options['max_height'] ?? 1080; // Max height for web
        $quality = $options['quality'] ?? 85; // JPEG quality (85 is good balance)
        $format = $options['format'] ?? 'auto'; // 'auto', 'jpg', 'webp', 'png'
        $skipOptimization = $options['skip_optimization'] ?? false; // For debugging
        
        // If optimization is disabled, just store the original
        if ($skipOptimization) {
            $originalPath = $image->storeAs($storagePath, $image->getClientOriginalName(), 'public');
            return $originalPath;
        }
        
        try {
            // Create image manager with GD driver
            $manager = new ImageManager(new Driver());
            
            // Read the image
            $img = $manager->read($image->getRealPath());
            
            // Get original dimensions
            $originalWidth = $img->width();
            $originalHeight = $img->height();
            
            // Calculate new dimensions maintaining aspect ratio
            if ($originalWidth > $maxWidth || $originalHeight > $maxHeight) {
                $img->scaleDown($maxWidth, $maxHeight);
            }
            
            // Determine output format
            $mimeType = $image->getMimeType();
            $originalExtension = strtolower($image->getClientOriginalExtension());
            
            if ($format === 'auto') {
                // Prefer WebP for better compression, fallback to original format
                if (function_exists('imagewebp')) {
                    $outputFormat = 'webp';
                    $outputExtension = 'webp';
                } else {
                    // Use JPEG for photos, PNG for graphics
                    $outputFormat = ($originalExtension === 'png' && $mimeType === 'image/png') ? 'png' : 'jpg';
                    $outputExtension = $outputFormat;
                }
            } else {
                $outputFormat = $format;
                $outputExtension = $format;
            }
            
            // Generate optimized filename
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $optimizedFilename = $originalName . '_opt.' . $outputExtension;
            
            // Determine if we're saving to public/ or storage/app/public/
            // If path starts with "images/", save to public/ (like carousel)
            // Otherwise, save to storage/app/public/ (Laravel storage)
            if (strpos($storagePath, 'images/') === 0) {
                $fullPath = public_path($storagePath . '/' . $optimizedFilename);
            } else {
                $fullPath = storage_path('app/public/' . $storagePath . '/' . $optimizedFilename);
            }
            
            // Ensure directory exists
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Encode and save with optimization
            if ($outputFormat === 'webp') {
                $img->toWebp($quality)->save($fullPath);
            } elseif ($outputFormat === 'jpg' || $outputFormat === 'jpeg') {
                $img->toJpeg($quality)->save($fullPath);
            } else {
                // PNG - use lossless compression
                $img->toPng()->save($fullPath);
            }
            
            // Return relative path for storage
            return $storagePath . '/' . $optimizedFilename;
            
        } catch (\Exception $e) {
            // Fallback: if optimization fails, store original file
            \Log::error('Image optimization failed: ' . $e->getMessage() . ' | File: ' . $image->getClientOriginalName());
            
            try {
                // Try to store the original file
                $originalPath = $image->storeAs($storagePath, $image->getClientOriginalName(), 'public');
                return $originalPath;
            } catch (\Exception $storeException) {
                \Log::error('Failed to store original image: ' . $storeException->getMessage());
                throw new \Exception('Failed to process image: ' . $e->getMessage());
            }
        }
    }
    
    /**
     * Get file size reduction info
     */
    public static function getSizeInfo($originalPath, $optimizedPath)
    {
        $originalFullPath = storage_path('app/public/' . $originalPath);
        $optimizedFullPath = storage_path('app/public/' . $optimizedPath);
        
        if (!file_exists($originalFullPath) || !file_exists($optimizedFullPath)) {
            return null;
        }
        
        $originalSize = filesize($originalFullPath);
        $optimizedSize = filesize($optimizedFullPath);
        $reduction = round((1 - ($optimizedSize / $originalSize)) * 100, 2);
        
        return [
            'original_size' => $originalSize,
            'optimized_size' => $optimizedSize,
            'reduction_percent' => $reduction,
            'original_size_mb' => round($originalSize / 1024 / 1024, 2),
            'optimized_size_mb' => round($optimizedSize / 1024 / 1024, 2)
        ];
    }
}

