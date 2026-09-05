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
        
        $sourcePath = $image->getRealPath();
        $tempJpeg = null;

        try {
            $tempJpeg = self::convertHeicToJpegIfNeeded($image);
            if ($tempJpeg) {
                $sourcePath = $tempJpeg;
            }

            // Create image manager with GD driver
            $manager = new ImageManager(new Driver());
            
            // Read the image
            $img = $manager->read($sourcePath);
            
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
            $originalName = $options['filename'] ?? pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $originalName = preg_replace('/[^a-zA-Z0-9_-]/', '_', (string) $originalName) ?: 'image';
            $optimizedFilename = $originalName . '_opt.' . $outputExtension;
            
            // Web-root folders (carousel images, staff files).
            if (self::isPublicWebPath($storagePath)) {
                $fullPath = self::webRootPath($storagePath) . '/' . $optimizedFilename;
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
                if (self::isHeic($image)) {
                    $converted = self::storeHeicAsJpeg($image, $storagePath);
                    if ($converted) {
                        return $converted;
                    }
                }

                // Try to store the original file
                $originalPath = $image->storeAs($storagePath, $image->getClientOriginalName(), 'public');
                return $originalPath;
            } catch (\Exception $storeException) {
                \Log::error('Failed to store original image: ' . $storeException->getMessage());
                throw new \Exception('Failed to process image: ' . $e->getMessage());
            }
        } finally {
            if ($tempJpeg && file_exists($tempJpeg)) {
                @unlink($tempJpeg);
            }
        }
    }

    protected static function isHeic($image): bool
    {
        $extension = strtolower($image->getClientOriginalExtension());
        $mime = strtolower((string) $image->getMimeType());

        return in_array($extension, ['heic', 'heif'], true)
            || in_array($mime, ['image/heic', 'image/heif', 'image/heic-sequence'], true);
    }

    /**
     * GD cannot decode HEIC. Convert via ImageMagick to a temp JPEG when needed.
     */
    protected static function convertHeicToJpegIfNeeded($image): ?string
    {
        if (!self::isHeic($image)) {
            return null;
        }

        $source = $image->getRealPath();
        $temp = sys_get_temp_dir() . '/' . uniqid('heic_', true) . '.jpg';
        $binary = self::imageMagickBinary();

        if (!$binary || !$source) {
            return null;
        }

        $cmd = escapeshellcmd($binary) . ' ' . escapeshellarg($source) . ' -auto-orient -quality 90 ' . escapeshellarg($temp) . ' 2>&1';
        exec($cmd, $output, $code);

        if ($code !== 0 || !file_exists($temp) || filesize($temp) < 1) {
            \Log::error('HEIC conversion failed: ' . implode("\n", $output));
            if (file_exists($temp)) {
                @unlink($temp);
            }
            return null;
        }

        return $temp;
    }

    protected static function storeHeicAsJpeg($image, string $storagePath): ?string
    {
        $tempJpeg = self::convertHeicToJpegIfNeeded($image);
        if (!$tempJpeg) {
            return null;
        }

        $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';

        if (self::isPublicWebPath($storagePath)) {
            $directory = self::webRootPath($storagePath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $dest = $directory . '/' . $filename;
            copy($tempJpeg, $dest);
            @unlink($tempJpeg);
            return $storagePath . '/' . $filename;
        }

        $contents = file_get_contents($tempJpeg);
        @unlink($tempJpeg);
        Storage::disk('public')->put($storagePath . '/' . $filename, $contents);

        return $storagePath . '/' . $filename;
    }

    protected static function isPublicWebPath(string $storagePath): bool
    {
        return strpos($storagePath, 'images/') === 0
            || strpos($storagePath, 'Staff/') === 0;
    }

    protected static function webRootPath(string $storagePath): string
    {
        if (strpos($storagePath, 'Staff/') === 0) {
            return StaffFolderHelper::absolutePath($storagePath);
        }

        return public_path($storagePath);
    }

    protected static function imageMagickBinary(): ?string
    {
        foreach (['/usr/local/bin/magick', '/usr/bin/magick', '/usr/local/bin/convert', '/usr/bin/convert'] as $path) {
            if (is_executable($path)) {
                return $path;
            }
        }

        return null;
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

