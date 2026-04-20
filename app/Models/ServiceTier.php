<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceTier extends Model
{
    public const TIER_SMALL = 'small';

    public const TIER_MEDIUM = 'medium';

    public const TIER_ENTERPRISE = 'enterprise';

    public const MODE_FIXED = 'fixed';

    public const MODE_PACKAGES = 'packages';

    public const MODE_QUOTE = 'quote';

    protected $fillable = [
        'service_id',
        'tier_key',
        'label',
        'pricing_mode',
    ];

    protected $casts = [
        'service_id' => 'integer',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function tierPrice(): HasOne
    {
        return $this->hasOne(ServiceTierPrice::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(ServicePackage::class)->orderBy('sort_order');
    }

    public function addons(): HasMany
    {
        return $this->hasMany(ServiceAddon::class)->orderBy('sort_order');
    }

    public function page(): HasOne
    {
        return $this->hasOne(ServiceTierPage::class);
    }
}
