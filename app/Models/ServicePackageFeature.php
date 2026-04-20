<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePackageFeature extends Model
{
    protected $fillable = [
        'service_package_id',
        'feature',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function servicePackage(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class, 'service_package_id');
    }
}
