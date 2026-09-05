<?php

namespace App\Services;

use App\Models\Client;

class ClientLeadService
{
    /**
     * @param  array{name: string, email: string, subject?: string, message?: string}  $payload
     */
    public function captureInquiry(array $payload): Client
    {
        $email = strtolower(trim((string) ($payload['email'] ?? '')));
        $fullName = trim((string) ($payload['name'] ?? ''));
        $parts = preg_split('/\s+/', $fullName, 2) ?: [];
        $first = $parts[0] ?? $fullName;
        $last = $parts[1] ?? '';
        $subject = trim((string) ($payload['subject'] ?? ''));
        $body = trim((string) ($payload['message'] ?? ''));
        $note = trim($subject.($subject !== '' && $body !== '' ? "\n" : '').$body);

        $client = $email !== ''
            ? Client::query()->whereRaw('LOWER(email) = ?', [$email])->first()
            : null;

        if (! $client) {
            $client = new Client;
            $client->email = $email !== '' ? $email : null;
            $client->status = Client::STATUS_LEAD;
        }

        if (! filled($client->name) && $first !== '') {
            $client->name = $first;
        }
        if (! filled($client->surname) && $last !== '') {
            $client->surname = $last;
        }
        if ($subject !== '') {
            $client->inquiry_subject = $subject;
        }
        if ($note !== '') {
            $client->inquiry_message = trim((string) $client->inquiry_message.($client->inquiry_message ? "\n\n" : '').$note);
        }
        if ($client->status !== Client::STATUS_CLIENT) {
            $client->status = Client::STATUS_LEAD;
        }

        $client->save();

        return $client;
    }

    public function convertFromSale(?int $clientId, ?string $clientName): ?Client
    {
        $client = $clientId ? Client::find($clientId) : null;

        if (! $client && filled($clientName)) {
            $client = $this->findByName((string) $clientName);
        }

        if (! $client && filled($clientName)) {
            $client = $this->createFromSaleName((string) $clientName);
        }

        if ($client) {
            $client->markAsClient();

            return $client->fresh();
        }

        return null;
    }

    public function findByName(string $name): ?Client
    {
        $name = trim($name);
        if ($name === '') {
            return null;
        }

        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            return Client::query()->whereRaw('LOWER(email) = ?', [strtolower($name)])->first();
        }

        return Client::query()
            ->where(function ($query) use ($name) {
                $query->whereRaw('LOWER(company) = ?', [strtolower($name)])
                    ->orWhereRaw("LOWER(TRIM(CONCAT(COALESCE(name,''), ' ', COALESCE(surname,'')))) = ?", [strtolower($name)])
                    ->orWhereRaw('LOWER(name) = ?', [strtolower($name)]);
            })
            ->orderByRaw("CASE WHEN status = ? THEN 0 ELSE 1 END", [Client::STATUS_LEAD])
            ->first();
    }

    private function createFromSaleName(string $name): Client
    {
        $parts = preg_split('/\s+/', trim($name), 2) ?: [];

        return Client::create([
            'name' => $parts[0] ?? $name,
            'surname' => $parts[1] ?? null,
            'company' => $name,
            'status' => Client::STATUS_CLIENT,
            'converted_at' => now(),
        ]);
    }
}
