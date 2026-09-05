<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\InternshipProgram;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class AnnouncementArchiveService
{
    public const ARCHIVE_AFTER_DAYS = 30;

    private const FILE = 'announcements-archive.json';

    public function all(): array
    {
        return $this->mutate(function (array $items) {
            return [
                'items' => $items,
                'changed' => false,
                'value' => $this->sorted($items),
            ];
        });
    }

    public function archiveDue(int $days = 0): int
    {
        $cutoff = now()->subDays($days);

        $due = Announcement::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', $cutoff)
            ->get();

        foreach ($due as $announcement) {
            $this->archive($announcement);
        }

        return $due->count();
    }

    public function archive(Announcement $announcement): void
    {
        $programIds = InternshipProgram::query()
            ->where('announcement_id', $announcement->id)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $payload = [
            'original_id' => (int) $announcement->id,
            'title' => $announcement->title,
            'message' => $announcement->message,
            'description' => $announcement->description,
            'link' => $announcement->link,
            'badge' => $announcement->badge,
            'image' => $announcement->image,
            'is_active' => (bool) $announcement->is_active,
            'expires_at' => optional($announcement->expires_at)->toIso8601String(),
            'created_at' => optional($announcement->created_at)->toIso8601String(),
            'updated_at' => optional($announcement->updated_at)->toIso8601String(),
            'program_ids' => $programIds,
            'archived_at' => now()->toIso8601String(),
        ];

        $this->mutate(function (array $items) use ($payload) {
            $items = array_values(array_filter(
                $items,
                fn ($item) => (int) ($item['original_id'] ?? 0) !== $payload['original_id']
            ));
            $items[] = $payload;

            return [
                'items' => $items,
                'changed' => true,
            ];
        });

        $announcement->delete();
    }

    public function restore(int $originalId): Announcement
    {
        $created = null;

        $this->mutate(function (array $items) use ($originalId, &$created) {
            $index = null;
            $record = null;

            foreach ($items as $i => $item) {
                if ((int) ($item['original_id'] ?? 0) === $originalId) {
                    $index = $i;
                    $record = $item;
                    break;
                }
            }

            if ($record === null) {
                throw (new ModelNotFoundException())->setModel(Announcement::class, [$originalId]);
            }

            $created = $this->insertFromArchive($record);
            unset($items[$index]);

            return [
                'items' => array_values($items),
                'changed' => true,
                'value' => $created,
            ];
        });

        return $created;
    }

    public function forget(int $originalId): void
    {
        $this->mutate(function (array $items) use ($originalId) {
            $filtered = array_values(array_filter(
                $items,
                fn ($item) => (int) ($item['original_id'] ?? 0) !== $originalId
            ));

            return [
                'items' => $filtered,
                'changed' => count($filtered) !== count($items),
            ];
        });
    }

    private function insertFromArchive(array $record): Announcement
    {
        $originalId = (int) ($record['original_id'] ?? 0);
        $reuseId = $originalId > 0 && ! Announcement::query()->whereKey($originalId)->exists();

        $announcement = new Announcement();
        if ($reuseId) {
            $announcement->id = $originalId;
        }

        $announcement->title = $record['title'] ?? null;
        $announcement->message = $record['message'] ?? ($record['description'] ?? null);
        $announcement->description = $record['description'] ?? ($record['message'] ?? null);
        $announcement->link = $record['link'] ?? null;
        $announcement->badge = $record['badge'] ?? null;
        $announcement->image = $record['image'] ?? null;
        $announcement->is_active = array_key_exists('is_active', $record)
            ? (bool) $record['is_active']
            : true;
        $announcement->expires_at = now()->addDays(self::ARCHIVE_AFTER_DAYS);

        if (! empty($record['created_at'])) {
            $announcement->created_at = Carbon::parse($record['created_at']);
        }

        $announcement->save();

        if (! $reuseId && $originalId > 0) {
            $this->relocateImage($originalId, (int) $announcement->id, $announcement);
        }

        $programIds = array_values(array_filter(array_map('intval', $record['program_ids'] ?? [])));
        if ($programIds !== []) {
            InternshipProgram::query()
                ->whereIn('id', $programIds)
                ->whereNull('announcement_id')
                ->update(['announcement_id' => $announcement->id]);
        }

        return $announcement;
    }

    private function relocateImage(int $fromId, int $toId, Announcement $announcement): void
    {
        if ($fromId === $toId) {
            return;
        }

        $oldFolder = public_path('Announcements/' . $fromId);
        $newFolder = public_path('Announcements/' . $toId);

        if (File::isDirectory($oldFolder) && ! File::isDirectory($newFolder)) {
            File::moveDirectory($oldFolder, $newFolder);
        }

        $image = $announcement->image;
        if (! is_string($image) || $image === '') {
            return;
        }

        $updated = str_replace('/Announcements/' . $fromId . '/', '/Announcements/' . $toId . '/', $image);
        if ($updated === $image) {
            return;
        }

        $announcement->image = $updated;
        $announcement->save();
    }

    private function sorted(array $items): array
    {
        usort($items, function ($a, $b) {
            return strcmp($b['archived_at'] ?? '', $a['archived_at'] ?? '');
        });

        return $items;
    }

    /**
     * @param  callable(array): array{items: array, changed?: bool, value?: mixed}  $callback
     * @return mixed
     */
    private function mutate(callable $callback)
    {
        $path = storage_path('app/' . self::FILE);
        $dir = dirname($path);

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $handle = fopen($path, 'c+');
        if ($handle === false) {
            throw new \RuntimeException('Unable to open announcement archive file.');
        }

        if (! flock($handle, LOCK_EX)) {
            fclose($handle);
            throw new \RuntimeException('Unable to lock announcement archive file.');
        }

        try {
            rewind($handle);
            $raw = stream_get_contents($handle);
            $items = json_decode($raw ?: '[]', true);
            if (! is_array($items)) {
                $items = [];
            }

            $result = $callback($items);
            $next = $result['items'] ?? $items;
            $changed = $result['changed'] ?? true;

            if ($changed) {
                $json = json_encode(
                    array_values($next),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                );
                if ($json === false) {
                    throw new \RuntimeException('Unable to encode announcement archive JSON.');
                }

                rewind($handle);
                ftruncate($handle, 0);
                fwrite($handle, $json);
                fflush($handle);
            }

            return array_key_exists('value', $result) ? $result['value'] : $next;
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}
