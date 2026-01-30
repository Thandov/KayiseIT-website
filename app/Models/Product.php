<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'icon_color',
        'features',
        'cta_text',
        'cta_route',
        'show_on_frontend',
        'display_order',
    ];

    protected $casts = [
        'features' => 'array',
        'show_on_frontend' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Scope to get only products visible on frontend
     */
    public function scopeVisibleOnFrontend($query)
    {
        return $query->where('show_on_frontend', true);
    }

    /**
     * Scope to order by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc')->orderBy('name', 'asc');
    }
}
