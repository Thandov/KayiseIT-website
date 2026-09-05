<?php

namespace App\Console\Commands;

use App\Services\Lmis\LmisProgramSyncService;
use Illuminate\Console\Command;

class SyncLmisOutbox extends Command
{
    protected $signature = 'lmis:sync-outbox';

    protected $description = 'Push pending Kayise programmes to LMIS when it is reachable';

    public function handle(LmisProgramSyncService $sync): int
    {
        $processed = $sync->flushPending();

        $this->info("Processed {$processed} LMIS outbox row(s).");

        return Command::SUCCESS;
    }
}
