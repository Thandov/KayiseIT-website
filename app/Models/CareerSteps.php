<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CareerSteps extends Model
{
    use HasFactory;

    protected $table = 'career_steps';

    protected $primaryKey = 'steps_id';

    protected $fillable = [
        'u_id',
        'occup_id',
        'spec_id',
        'step_number',
        'qualification',
        'title',
        'summary',
        'nqf_level',
        'duration',
        'typical_cost',
        'prerequisites',
        'providers',
        'next_action',
    ];

    protected $casts = [
        'prerequisites' => 'array',
        'providers' => 'array',
        'step_number' => 'integer',
        'nqf_level' => 'integer',
    ];

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specializations::class, 'spec_id', 'spec_id');
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupations::class, 'occup_id', 'occup_id');
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(
            Module::class,
            'career_step_module',
            'steps_id',
            'module_id',
            'steps_id',
            'id'
        );
    }

    public function displayTitle(): string
    {
        return $this->title ?: $this->qualification;
    }
}
