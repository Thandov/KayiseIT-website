<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class StaffInvite extends Model
{
    protected $fillable = [
        'email',
        'token',
        'invited_by',
        'expires_at',
        'accepted_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isAccepted(): bool
    {
        return $this->accepted_at !== null;
    }

    public function isPending(): bool
    {
        return ! $this->isAccepted() && ! $this->isExpired();
    }

    public function registrationUrl(): string
    {
        return route('staff.register', $this->token);
    }

    public static function generateToken(): string
    {
        return Str::random(64);
    }

    public static function findValidByToken(string $token): ?self
    {
        $invite = static::where('token', $token)->first();

        if (! $invite || ! $invite->isPending()) {
            return null;
        }

        return $invite;
    }

    public static function hasPendingInvite(string $email): bool
    {
        return static::where('email', $email)
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->exists();
    }
}
