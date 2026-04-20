<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTierPrice extends Model
{
    protected $fillable = [
        'service_tier_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function tier(): BelongsTo
    {
        return $this->belongsTo(ServiceTier::class, 'service_tier_id');
    }
}
