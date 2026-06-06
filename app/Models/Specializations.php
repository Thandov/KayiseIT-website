<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specializations extends Model
{
    use HasFactory;

    protected $table = 'specializations';

    protected $primaryKey = 'spec_id';

    protected $fillable = [
        'occup_id',
        'specialization_name',
    ];

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupations::class, 'occup_id', 'occup_id');
    }

    public function careerSteps(): HasMany
    {
        return $this->hasMany(CareerSteps::class, 'spec_id', 'spec_id')
            ->orderBy('step_number');
    }
}
