<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTierPage extends Model
{
    protected $fillable = [
        'service_tier_id',
        'meta_title',
        'meta_description',
        'hero_heading',
        'hero_subheading',
        'body',
        'sections',
        'primary_cta_label',
        'primary_cta_href',
    ];

    protected $casts = [
        'sections' => 'array',
    ];

    public function tier(): BelongsTo
    {
        return $this->belongsTo(ServiceTier::class, 'service_tier_id');
    }
}
