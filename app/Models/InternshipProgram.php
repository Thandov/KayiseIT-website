<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'program_type',
        'partner_id',
        'description',
        'image_path',
        'gallery',
        'duration',
        'recruitment_start_date',
        'recruitment_end_date',
        'number_needed',
        'sponsors_partners',
        'has_stipend',
        'stipend_amount',
        'stipend_currency',
        'has_accreditation',
        'accreditation_details',
        'youth_beneficiaries',
        'requirements',
        'qr_code_path',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'sponsors_partners' => 'array',
        'recruitment_start_date' => 'date',
        'recruitment_end_date' => 'date',
        'has_stipend' => 'boolean',
        'has_accreditation' => 'boolean',
        'youth_beneficiaries' => 'boolean',
        'is_active' => 'boolean',
        'stipend_amount' => 'decimal:2',
    ];

    // Accessor for full image URL
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    // Accessor for QR code URL
    public function getQrCodeUrlAttribute()
    {
        return $this->qr_code_path ? asset('storage/' . $this->qr_code_path) : null;
    }

    // Accessor for gallery URLs
    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery) {
            return [];
        }
        
        return array_map(function($path) {
            return asset('storage/' . $path);
        }, $this->gallery);
    }

    // Scope for active programs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for currently recruiting programs
    public function scopeCurrentlyRecruiting($query)
    {
        return $query->where('recruitment_start_date', '<=', now())
                    ->where('recruitment_end_date', '>=', now());
    }

    // Relationships
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    // Check if partner is MICT SETA
    public function isMictPartner()
    {
        return $this->partner && (
            stripos($this->partner->name, 'MICT') !== false || 
            stripos($this->partner->name, 'MICT SETA') !== false
        );
    }
}
