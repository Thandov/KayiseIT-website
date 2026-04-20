<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Legacy `service_type` and `price` remain on the table for backward compatibility and are
 * synced from tier data via {@see \App\Services\ServiceTierSyncService}.
 */
class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'service_id',
        'icon',
        'name',
        'slug',
        'description',
        'service_type',
        'price',
    ];

    /**
     * Subservices use the string `services.service_id` (not numeric id).
     */
    public function subservices(): HasMany
    {
        return $this->hasMany(Subservice::class, 'service_id', 'service_id');
    }

    public function tiers(): HasMany
    {
        return $this->hasMany(ServiceTier::class);
    }

    public function publicSlug(): string
    {
        return str_replace('_', '-', $this->slug);
    }
}
