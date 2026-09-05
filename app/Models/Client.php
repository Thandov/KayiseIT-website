<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    public const STATUS_LEAD = 'lead';
    public const STATUS_CLIENT = 'client';

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'email',
        'phone',
        'company',
        'address',
        'province',
        'status',
        'inquiry_subject',
        'inquiry_message',
        'converted_at',
    ];

    protected $casts = [
        'converted_at' => 'datetime',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(StaffSale::class);
    }

    public function isLead(): bool
    {
        return $this->status !== self::STATUS_CLIENT;
    }

    public function isConvertedClient(): bool
    {
        return $this->status === self::STATUS_CLIENT;
    }

    public function displayName(): string
    {
        $full = trim(implode(' ', array_filter([(string) $this->name, (string) $this->surname])));
        if ($full !== '') {
            return $full;
        }
        if (filled($this->company)) {
            return (string) $this->company;
        }

        return (string) ($this->email ?: 'Record #'.$this->id);
    }

    public function statusLabel(): string
    {
        return $this->isConvertedClient() ? 'Client' : 'Lead';
    }

    public function markAsClient(): void
    {
        if ($this->isConvertedClient()) {
            return;
        }

        $this->status = self::STATUS_CLIENT;
        $this->converted_at = now();
        $this->save();
    }

    public function scopeLeads($query)
    {
        return $query->where('status', self::STATUS_LEAD);
    }

    public function scopeConverted($query)
    {
        return $query->where('status', self::STATUS_CLIENT);
    }
}
