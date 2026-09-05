<?php

namespace App\Services\Lmis;

use App\Models\SiteSetting;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class LmisClient
{
    public function health(): void
    {
        $this->request('get', '/api/health');
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    public function createProgramme(array $payload): array
    {
        $data = $this->request('post', '/api/programmes', $payload);

        return is_array($data) ? $data : [];
    }

    /**
     * @param  array<string, mixed>|null  $payload
     * @return array<string, mixed>|null
     */
    private function request(string $method, string $path, ?array $payload = null): ?array
    {
        $settings = SiteSetting::current();
        $baseUrl = rtrim((string) $settings->lmis_base_url, '/');

        if ($baseUrl === '') {
            throw new LmisRequestException('LMIS base URL is not configured.');
        }

        $pending = Http::baseUrl($baseUrl)
            ->acceptJson()
            ->asJson()
            ->timeout((int) config('lmis.timeout', 10))
            ->connectTimeout((int) config('lmis.connect_timeout', 5));

        $token = $settings->lmis_api_token;
        if (is_string($token) && $token !== '') {
            $pending = $pending->withToken($token);
        }

        try {
            $response = $method === 'post'
                ? $pending->post($path, $payload ?? [])
                : $pending->get($path);
        } catch (ConnectionException $e) {
            throw new LmisRequestException('LMIS is unreachable: '.$e->getMessage(), 0, $e);
        } catch (Throwable $e) {
            throw new LmisRequestException('LMIS request failed: '.$e->getMessage(), 0, $e);
        }

        if (! $response->successful()) {
            $body = trim((string) $response->body());
            $snippet = $body !== '' ? mb_substr($body, 0, 240) : $response->reason();
            throw new LmisRequestException(
                'LMIS returned HTTP '.$response->status().($snippet !== '' ? ': '.$snippet : '')
            );
        }

        $json = $response->json();

        return is_array($json) ? $json : null;
    }
}
