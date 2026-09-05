<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WebsiteScreenshotService
{
    /**
     * Capture a desktop screenshot of a public URL and store it under public/images/case-studies.
     * Uses WordPress mShots (no API key). Returns a public-relative path or null on failure.
     */
    public function capture(string $url, string $filenamePrefix = 'shot'): ?string
    {
        $url = trim($url);
        if ($url === '' || ! filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        $shotUrl = 'https://s.wordpress.com/mshots/v1/'.rawurlencode($url).'?w=1400';
        $binary = null;

        // First hit often queues the render; later hits return the real JPEG.
        for ($attempt = 1; $attempt <= 6; $attempt++) {
            try {
                $response = Http::timeout(60)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (compatible; KayiseIT-CaseStudyBot/1.0)',
                        'Accept' => 'image/jpeg,image/png,image/webp,image/*;q=0.8,*/*;q=0.5',
                    ])
                    ->get($shotUrl);

                if (! $response->successful()) {
                    usleep(1500000);
                    continue;
                }

                $body = $response->body();
                if ($this->looksLikeRealScreenshot($body)) {
                    $binary = $body;
                    break;
                }

                // Placeholder / still rendering — wait longer each attempt.
                usleep(min(4000000, 800000 * $attempt));
            } catch (\Throwable $e) {
                Log::warning('Website screenshot attempt failed', [
                    'url' => $url,
                    'attempt' => $attempt,
                    'error' => $e->getMessage(),
                ]);
                usleep(1000000);
            }
        }

        if (! $binary) {
            Log::warning('Website screenshot capture gave up', ['url' => $url]);

            return null;
        }

        $folder = public_path('images/case-studies');
        if (! is_dir($folder)) {
            @mkdir($folder, 0755, true);
        }

        $filename = $filenamePrefix.'_'.time().'_'.Str::random(6).'.jpg';
        $fullPath = $folder.DIRECTORY_SEPARATOR.$filename;

        if (@file_put_contents($fullPath, $binary) === false) {
            return null;
        }

        return '/images/case-studies/'.$filename;
    }

    private function looksLikeRealScreenshot(string $body): bool
    {
        // mShots loading placeholder is a small GIF (~8KB, 400x300).
        if (strlen($body) < 20000) {
            return false;
        }

        $info = @getimagesizefromstring($body);
        if (! is_array($info) || empty($info[0]) || empty($info[1])) {
            return false;
        }

        $width = (int) $info[0];
        $height = (int) $info[1];
        $mime = strtolower((string) ($info['mime'] ?? ''));

        if (Str::contains($mime, 'gif')) {
            return false;
        }

        // Real desktop shots at w=1400 are wide; reject tiny placeholders.
        return $width >= 800 && $height >= 400;
    }
}
