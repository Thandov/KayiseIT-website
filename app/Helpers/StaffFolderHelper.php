<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StaffFolderHelper
{
    public const DOCUMENT_TYPES = [
        'id_copy' => [
            'folder' => 'ID_Copy',
            'column' => 'id_copy_path',
            'label' => 'ID Copy',
            'filename' => 'id_copy',
        ],
        'bank_confirmation' => [
            'folder' => 'Bank_Confirmation',
            'column' => 'bank_confirmation_path',
            'label' => 'Bank confirmation letter',
            'filename' => 'bank_confirmation',
        ],
        'cv' => [
            'folder' => 'CV',
            'column' => 'cv_path',
            'label' => 'CV',
            'filename' => 'cv',
        ],
        'sars_income_tax' => [
            'folder' => 'SARS_Income_Tax',
            'column' => 'sars_income_tax_path',
            'label' => 'SARS Income Tax',
            'filename' => 'sars_income_tax',
        ],
    ];

    public const DOCUMENT_RULE = 'nullable|file|mimes:pdf,jpg,jpeg,png,webp,doc,docx|max:10240';

    public static function slug(string $firstName, string $lastName): string
    {
        $first = Str::slug($firstName, '_');
        $last = Str::slug($lastName, '_');
        $slug = trim($first.'_'.$last, '_');

        return $slug !== '' ? $slug : 'staff';
    }

    public static function relativeDirectory(string $firstName, string $lastName): string
    {
        return 'Staff/'.self::slug($firstName, $lastName);
    }

    /**
     * Absolute path under the web document root.
     * On this host the Laravel base path is the document root (Staff/ lives next to index.php),
     * while public_path() points at a nested public/ directory.
     */
    public static function absolutePath(string $relative = ''): string
    {
        $relative = ltrim(str_replace(['\\', '..'], ['/', ''], $relative), '/');
        $baseStaff = base_path('Staff');
        $root = is_dir($baseStaff) ? base_path() : public_path();

        return $relative === '' ? $root : $root.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relative);
    }

    public static function ensureDirectory(string $firstName, string $lastName): string
    {
        $relative = self::relativeDirectory($firstName, $lastName);
        $full = self::absolutePath($relative);

        if (! File::isDirectory($full)) {
            File::makeDirectory($full, 0755, true);
        }

        foreach (self::DOCUMENT_TYPES as $meta) {
            $sub = $full.DIRECTORY_SEPARATOR.$meta['folder'];
            if (! File::isDirectory($sub)) {
                File::makeDirectory($sub, 0755, true);
            }
        }

        return $relative;
    }

    public static function renameDirectory(string $oldFirst, string $oldLast, string $newFirst, string $newLast): void
    {
        $fromRelative = self::relativeDirectory($oldFirst, $oldLast);
        $toRelative = self::relativeDirectory($newFirst, $newLast);
        $from = self::absolutePath($fromRelative);
        $to = self::absolutePath($toRelative);

        if ($fromRelative === $toRelative) {
            self::ensureDirectory($newFirst, $newLast);

            return;
        }

        if (File::isDirectory($from) && ! File::isDirectory($to)) {
            File::move($from, $to);
            self::ensureDirectory($newFirst, $newLast);

            return;
        }

        self::ensureDirectory($newFirst, $newLast);

        if (! File::isDirectory($from)) {
            return;
        }

        self::mergeDirectories($from, $to);
        File::deleteDirectory($from);
    }

    public static function storeUpload(UploadedFile $file, string $firstName, string $lastName): string
    {
        $directory = self::ensureDirectory($firstName, $lastName);

        try {
            return ImageOptimizer::optimize($file, $directory, [
                'max_width' => 1200,
                'max_height' => 1200,
                'quality' => 85,
                'filename' => 'profile',
            ]);
        } catch (\Throwable $e) {
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'profile.'.$extension;
            $file->move(self::absolutePath($directory), $filename);

            return $directory.'/'.$filename;
        }
    }

    public static function storeDocument(UploadedFile $file, string $firstName, string $lastName, string $type): string
    {
        if (! isset(self::DOCUMENT_TYPES[$type])) {
            throw new \InvalidArgumentException('Unknown staff document type.');
        }

        $meta = self::DOCUMENT_TYPES[$type];
        $directory = self::ensureDirectory($firstName, $lastName).'/'.$meta['folder'];
        $full = self::absolutePath($directory);

        if (! File::isDirectory($full)) {
            File::makeDirectory($full, 0755, true);
        }

        foreach (File::files($full) as $existing) {
            File::delete($existing->getPathname());
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'pdf');
        $filename = $meta['filename'].'.'.$extension;
        $file->move($full, $filename);

        return $directory.'/'.$filename;
    }

    public static function relocateStaffPath(?string $path, string $firstName, string $lastName): ?string
    {
        if (! $path) {
            return $path;
        }

        $path = ltrim($path, '/');
        if (! str_starts_with($path, 'Staff/')) {
            return $path;
        }

        $parts = explode('/', $path, 3);
        if (count($parts) < 3) {
            return self::relativeDirectory($firstName, $lastName).'/'.basename($path);
        }

        return self::relativeDirectory($firstName, $lastName).'/'.$parts[2];
    }

    public static function relocateProfilePath(?string $path, string $firstName, string $lastName): ?string
    {
        return self::relocateStaffPath($path, $firstName, $lastName);
    }

    public static function deleteStored(?string $path): void
    {
        if (! $path) {
            return;
        }

        $path = ltrim($path, '/');
        $publicFile = self::absolutePath($path);
        if (is_file($publicFile)) {
            @unlink($publicFile);
        }

        $nestedPublic = public_path($path);
        if ($nestedPublic !== $publicFile && is_file($nestedPublic)) {
            @unlink($nestedPublic);
        }

        $storageFile = storage_path('app/public/'.$path);
        if (is_file($storageFile)) {
            @unlink($storageFile);
        }
    }

    public static function deleteDirectory(string $firstName, string $lastName): void
    {
        $dir = self::absolutePath(self::relativeDirectory($firstName, $lastName));
        if (File::isDirectory($dir)) {
            File::deleteDirectory($dir);
        }
    }

    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $path = ltrim($path, '/');
        if (str_starts_with($path, 'Staff/') || is_file(self::absolutePath($path)) || is_file(public_path($path))) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }

    public static function uploadErrorMessage(UploadedFile $file): string
    {
        return match ($file->getError()) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'The file is too large. Maximum size is 10MB.',
            default => 'The file could not be uploaded. Use PDF, JPG, PNG, WebP, DOC, or DOCX up to 10MB.',
        };
    }

    protected static function mergeDirectories(string $from, string $to): void
    {
        if (! File::isDirectory($to)) {
            File::makeDirectory($to, 0755, true);
        }

        foreach (File::directories($from) as $dir) {
            $dest = $to.DIRECTORY_SEPARATOR.basename($dir);
            if (! File::isDirectory($dest)) {
                File::move($dir, $dest);
            } else {
                self::mergeDirectories($dir, $dest);
            }
        }

        foreach (File::files($from) as $file) {
            File::move($file->getPathname(), $to.DIRECTORY_SEPARATOR.$file->getFilename());
        }
    }
}
