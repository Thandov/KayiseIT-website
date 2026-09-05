<?php

namespace App\Services\Lmis;

use App\Models\InternshipProgram;
use App\Models\LmisSyncOutbox;
use App\Models\SiteSetting;
use Carbon\Carbon;

class LmisProgramSyncService
{
    public const RESULT_SKIPPED = 'skipped';
    public const RESULT_SYNCED = 'synced';
    public const RESULT_PENDING = 'pending';
    public const RESULT_FAILED = 'failed';

    public function __construct(private LmisClient $client)
    {
    }

    public function queueProgram(InternshipProgram $program): string
    {
        if (! SiteSetting::current()->lmis_enabled) {
            return self::RESULT_SKIPPED;
        }

        $program->loadMissing('partner');

        $externalId = 'kayise-program-'.$program->id;
        $payload = $this->payloadFor($program, $externalId);

        $row = LmisSyncOutbox::query()->firstOrCreate(
            ['external_id' => $externalId],
            [
                'entity_type' => LmisSyncOutbox::ENTITY_PROGRAM,
                'entity_id' => $program->id,
                'payload' => $payload,
                'status' => LmisSyncOutbox::STATUS_PENDING,
            ]
        );

        if ($row->status === LmisSyncOutbox::STATUS_SYNCED) {
            return self::RESULT_SYNCED;
        }

        if ($row->wasRecentlyCreated === false) {
            $row->payload = $payload;
            $row->status = LmisSyncOutbox::STATUS_PENDING;
            $row->save();
        }

        $this->flushOne($row, true);

        return $row->fresh()->status === LmisSyncOutbox::STATUS_SYNCED
            ? self::RESULT_SYNCED
            : self::RESULT_PENDING;
    }

    public function flushPending(int $limit = 20): int
    {
        $processed = 0;
        $candidates = LmisSyncOutbox::query()
            ->where('status', LmisSyncOutbox::STATUS_PENDING)
            ->orderBy('id')
            ->limit($limit * 3)
            ->get();

        foreach ($candidates as $row) {
            if (! $this->isDue($row)) {
                continue;
            }

            $this->flushOne($row);
            $processed++;

            if ($processed >= $limit) {
                break;
            }
        }

        return $processed;
    }

    public function flushOne(LmisSyncOutbox $row, bool $ignoreBackoff = false): void
    {
        if ($row->status === LmisSyncOutbox::STATUS_SYNCED) {
            return;
        }

        if (! $ignoreBackoff && ! $this->isDue($row)) {
            return;
        }

        try {
            $response = $this->client->createProgramme($row->payload ?? []);
            $row->status = LmisSyncOutbox::STATUS_SYNCED;
            $row->lmis_id = isset($response['id']) ? (string) $response['id'] : $row->lmis_id;
            $row->last_error = null;
            $row->synced_at = now();
            $row->attempts = $row->attempts + 1;
            $row->save();
        } catch (LmisRequestException $e) {
            $this->markAttemptFailed($row, $e->getMessage());
        } catch (\Throwable $e) {
            $this->markAttemptFailed($row, $e->getMessage());
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function payloadFor(InternshipProgram $program, string $externalId): array
    {
        return [
            'external_id' => $externalId,
            'source' => 'kayiseit',
            'name' => $program->name,
            'program_type' => $program->program_type,
            'description' => $program->description,
            'duration' => $program->duration,
            'recruitment_start_date' => optional($program->recruitment_start_date)->format('Y-m-d'),
            'recruitment_end_date' => optional($program->recruitment_end_date)->format('Y-m-d'),
            'number_needed' => (int) $program->number_needed,
            'has_stipend' => (bool) $program->has_stipend,
            'stipend_amount' => $program->stipend_amount !== null ? (float) $program->stipend_amount : null,
            'stipend_currency' => $program->stipend_currency,
            'has_accreditation' => (bool) $program->has_accreditation,
            'accreditation_details' => $program->accreditation_details,
            'youth_beneficiaries' => (bool) $program->youth_beneficiaries,
            'requirements' => $program->requirements,
            'is_active' => (bool) $program->is_active,
            'allows_enquiry' => (bool) $program->allows_enquiry,
            'partner_name' => $program->partner?->name,
        ];
    }

    private function isDue(LmisSyncOutbox $row): bool
    {
        if ($row->status !== LmisSyncOutbox::STATUS_PENDING) {
            return false;
        }

        if ((int) $row->attempts === 0) {
            return true;
        }

        $backoffSeconds = $this->backoffSeconds((int) $row->attempts);
        $dueAt = Carbon::parse($row->updated_at)->addSeconds($backoffSeconds);

        return now()->greaterThanOrEqualTo($dueAt);
    }

    private function backoffSeconds(int $attempts): int
    {
        $exponent = max(0, $attempts - 1);

        return (int) min(60 * (2 ** min($exponent, 6)), 3600);
    }

    private function markAttemptFailed(LmisSyncOutbox $row, string $error): void
    {
        $maxAttempts = (int) config('lmis.max_attempts', 10);
        $row->attempts = $row->attempts + 1;
        $row->last_error = mb_substr($error, 0, 2000);
        $row->status = $row->attempts >= $maxAttempts
            ? LmisSyncOutbox::STATUS_FAILED
            : LmisSyncOutbox::STATUS_PENDING;
        $row->save();
    }
}
