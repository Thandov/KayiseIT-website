<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceAddon extends Model
{
    public const PRICING_FIXED = 'fixed';

    public const PRICING_QUANTITY = 'quantity';

    protected $fillable = [
        'service_tier_id',
        'name',
        'price',
        'pricing_type',
        'unit_label',
        'min_qty',
        'max_qty',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'min_qty' => 'integer',
        'max_qty' => 'integer',
        'sort_order' => 'integer',
    ];

    public function tier(): BelongsTo
    {
        return $this->belongsTo(ServiceTier::class, 'service_tier_id');
    }
}
