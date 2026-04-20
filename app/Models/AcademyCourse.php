<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademyCourse extends Model
{
    public const ICON_KEYS = [
        'monitor',
        'drone_hex',
        'document',
        'bars',
        'shield',
        'plus',
    ];

    protected $fillable = [
        'title',
        'description',
        'category',
        'icon_key',
        'display_order',
        'show_on_frontend',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'show_on_frontend' => 'boolean',
    ];

    public function scopeVisibleOnFrontend($query)
    {
        return $query->where('show_on_frontend', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }
}
