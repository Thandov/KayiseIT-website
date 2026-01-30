<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Photos;

class CleanOrphanGalleryImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gallery:clean-orphans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete gallery image files on disk that are not referenced in the photos table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $basePath = storage_path('app/public/gallery');

        if (!File::isDirectory($basePath)) {
            $this->info('No gallery directory found, nothing to clean.');
            return Command::SUCCESS;
        }

        $allFiles = File::allFiles($basePath);
        $deleted = 0;
        $kept = 0;

        foreach ($allFiles as $file) {
            $relativePath = str_replace(storage_path('app/public/') , '', $file->getRealPath());

            // Normalise slashes
            $relativePath = str_replace('\\', '/', $relativePath);

            $inDb = Photos::where('path', $relativePath)->exists();

            if ($inDb) {
                $kept++;
                continue;
            }

            File::delete($file->getRealPath());
            $deleted++;
        }

        $this->info("Cleanup complete. Deleted {$deleted} orphan file(s), kept {$kept} referenced file(s).");

        return Command::SUCCESS;
    }
}


