<?php

namespace App\Models;

use App\Services\ServiceLifecycleService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::deleting(function (Service $service) {
            $lifecycle = app(ServiceLifecycleService::class);
            $lifecycle->deleteRelatedRecords($service);
            $lifecycle->deleteBladeForService($service);
        });
    }

    public static function slugFromName(string $name): string
    {
        return Str::slug($name);
    }

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

    public function bladeComponentSlug(): string
    {
        return app(ServiceLifecycleService::class)->bladeComponentSlug($this);
    }

    public function componentViewName(): string
    {
        return app(ServiceLifecycleService::class)->componentViewName($this);
    }
}
