<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    
    protected $table = 'partners';

    protected $fillable = [
        'name',
        'partner_type',
        'logo_path',
        'website_url',
        'description',
        'display_order',
        'is_active',
        'mou_signed',
        'mou_date',
        'mou_document',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'mou_signed' => 'boolean',
        'mou_date' => 'date',
        'display_order' => 'integer',
    ];

    // Accessor for full logo URL
    public function getLogoUrlAttribute()
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    // Scope for active partners
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordered partners
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc')->orderBy('created_at', 'desc');
    }

    // Scope for skills development partners
    public function scopeSkillsDevelopment($query)
    {
        return $query->where('partner_type', 'Skills Development');
    }

    // Scope for MOU partners
    public function scopeWithMou($query)
    {
        return $query->where('mou_signed', true);
    }

    // Relationships
    public function programs()
    {
        return $this->hasMany(InternshipProgram::class);
    }
}
