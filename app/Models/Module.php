<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'nqf_level',
        'duration_months',
        'description',
        'registration_url',
        'accreditation_body',
        'accreditation_status',
        'accreditation_number',
        'accreditation_expires_at',
        'is_registration_open',
    ];

    protected $casts = [
        'accreditation_expires_at' => 'date',
        'is_registration_open' => 'boolean',
    ];

    public function careerSteps(): BelongsToMany
    {
        return $this->belongsToMany(
            CareerSteps::class,
            'career_step_module',
            'module_id',
            'steps_id',
            'id',
            'steps_id'
        );
    }

    public function isRegisterable(): bool
    {
        return $this->accreditation_status === 'accredited'
            && in_array($this->accreditation_body, ['QCTO', 'MICT_SETA'], true)
            && $this->is_registration_open
            && (!$this->accreditation_expires_at || $this->accreditation_expires_at->isFuture());
    }
}
