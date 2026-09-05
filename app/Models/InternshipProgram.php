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
        'allows_enquiry',
        'application_form_schema',
        'announcement_id',
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
        'allows_enquiry' => 'boolean',
        'application_form_schema' => 'array',
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

    public function scopeEnquiryEnabled($query)
    {
        return $query->active()->where('allows_enquiry', true);
    }

    /** Programmes collecting interest before official launch (shown on /programs for enquiry). */
    public function scopeCollectingEnquiries($query)
    {
        return $query->enquiryEnabled()->orderBy('name');
    }

    /** Programmes actively running (shown on /programs as live). */
    public function scopeActivelyRunning($query)
    {
        return $query->active()->where('allows_enquiry', false)->orderBy('name');
    }

    public function isCollectingEnquiries(): bool
    {
        return $this->is_active && $this->allows_enquiry;
    }

    public function isActivelyRunning(): bool
    {
        return $this->is_active && ! $this->allows_enquiry;
    }

    public function people()
    {
        return $this->hasMany(Person::class, 'internship_program_id');
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

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    // Check if partner is MICT SETA
    public function isMictPartner()
    {
        return $this->partner && (
            stripos($this->partner->name, 'MICT') !== false || 
            stripos($this->partner->name, 'MICT SETA') !== false
        );
    }

    /** @return list<string> */
    public function getFormFieldKeys(): array
    {
        return \App\Support\ProgramFormFields::normalizeSelected(
            $this->application_form_schema,
            $this->program_type ?? 'Internship',
            (bool) $this->allows_enquiry
        );
    }

    /** @return array<string, array{label: string, fields: list<array<string, mixed>>}> */
    public function getGroupedFormFields(): array
    {
        return \App\Support\ProgramFormFields::groupedBySection($this->getFormFieldKeys());
    }
}
