<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    public const TYPE_ENQUIRY = 'enquiry';

    public const TYPE_APPLICATION = 'application';

    protected $fillable = [
        'record_type',
        'user_id',
        'legacy_application_id',
        'app_id',
        'name',
        'surname',
        'id_number',
        'email',
        'cellphone',
        'country',
        'province',
        'location_type',
        'location_name',
        'internship_program_id',
        'source',
        'age',
        'address',
        'high_school',
        'year_of_completion',
        'qualification',
        'year_obtained',
        'institution',
        'app_type',
        'field',
        'program_partner',
        'status',
        'cv_path',
        'id_copy_path',
        'qualification_copy_path',
        'proof_of_payment_path',
        'custom_fields',
        'admin_message',
        'responded_at',
        'responded_by',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'custom_fields' => 'array',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(InternshipProgram::class, 'internship_program_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function internLearner(): HasOne
    {
        return $this->hasOne(InternsLearner::class, 'person_id');
    }

    public function mictBeneficiary(): HasOne
    {
        return $this->hasOne(MictBeneficiary::class, 'person_id');
    }

    public function scopeEnquiries($query)
    {
        return $query->where('record_type', self::TYPE_ENQUIRY);
    }

    public function scopeApplications($query)
    {
        return $query->where('record_type', self::TYPE_APPLICATION);
    }

    public function isApplication(): bool
    {
        return $this->record_type === self::TYPE_APPLICATION;
    }

    public function isEnquiry(): bool
    {
        return $this->record_type === self::TYPE_ENQUIRY;
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->name.' '.$this->surname);
    }

    public function getLocationTypeLabelAttribute(): string
    {
        if ($this->location_type === 'township') {
            return 'Township';
        }

        if ($this->location_type === 'town') {
            return 'Town';
        }

        return '—';
    }

    public function getRecordTypeLabelAttribute(): string
    {
        return $this->isApplication() ? 'Application' : 'Enquiry';
    }

    public function getStatusLabelAttribute(): ?string
    {
        return $this->status ? ucfirst($this->status) : null;
    }
}
