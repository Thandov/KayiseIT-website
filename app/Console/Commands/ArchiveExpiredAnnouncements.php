<?php

namespace App\Console\Commands;

use App\Services\AnnouncementArchiveService;
use Illuminate\Console\Command;

class ArchiveExpiredAnnouncements extends Command
{
    protected $signature = 'announcements:archive-expired
                            {--days=0 : Extra days after expiry before moving to JSON}';

    protected $description = 'Archive expired announcements into JSON';

    public function handle(AnnouncementArchiveService $archive): int
    {
        $days = (int) $this->option('days');

        if ($days < 0) {
            $this->error('Days must be 0 or greater.');

            return self::FAILURE;
        }

        $count = $archive->archiveDue($days);
        $this->info("Archived {$count} announcement(s) to JSON.");

        return self::SUCCESS;
    }
}
