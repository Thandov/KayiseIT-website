<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\InternshipProgram;

class ProgramAnnouncementService
{
    public function defaultFields(InternshipProgram $program): array
    {
        return [
            'title' => 'New programme: ' . $program->name,
            'description' => $program->description,
            'link' => route('programs'),
            'badge' => 'OPPORTUNITY',
            'expires_at' => $program->recruitment_end_date
                ? $program->recruitment_end_date->endOfDay()->format('Y-m-d\TH:i')
                : null,
        ];
    }

    public function createForProgram(InternshipProgram $program, array $data): Announcement
    {
        $announcement = new Announcement();
        $announcement->title = $data['title'];
        $announcement->message = $data['description'];
        $announcement->description = $data['description'];
        $announcement->link = $data['link'] ?? route('programs');
        $announcement->badge = $data['badge'] ?? 'OPPORTUNITY';
        $announcement->is_active = true;
        $announcement->expires_at = ! empty($data['expires_at'])
            ? $data['expires_at']
            : now()->addDays(7);
        $announcement->save();

        $program->announcement_id = $announcement->id;
        $program->save();

        return $announcement;
    }

    public function updateForProgram(InternshipProgram $program, array $data): ?Announcement
    {
        $announcement = $program->announcement;

        if (! $announcement) {
            return $this->createForProgram($program, $data);
        }

        $announcement->title = $data['title'];
        $announcement->message = $data['description'];
        $announcement->description = $data['description'];
        $announcement->link = $data['link'] ?? route('programs');
        $announcement->badge = $data['badge'] ?? $announcement->badge;
        $announcement->is_active = true;
        if (! empty($data['expires_at'])) {
            $announcement->expires_at = $data['expires_at'];
        }
        $announcement->save();

        return $announcement;
    }

    public function unpublishForProgram(InternshipProgram $program): void
    {
        $announcement = $program->announcement;

        if (! $announcement) {
            return;
        }

        $announcement->is_active = false;
        $announcement->save();
    }
}
