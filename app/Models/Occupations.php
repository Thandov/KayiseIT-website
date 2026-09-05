<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Occupations extends Model
{
    use HasFactory;

    protected $table = 'occupations';

    protected $primaryKey = 'occup_id';

    protected $fillable = [
        'u_id',
        'occupation_name',
        'slug',
        'description',
        'day_in_life',
        'entry_salary_min',
        'entry_salary_max',
        'is_published',
        'display_order',
        'occupation_banner',
        'image',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'entry_salary_min' => 'integer',
        'entry_salary_max' => 'integer',
        'display_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function specializations(): HasMany
    {
        return $this->hasMany(Specializations::class, 'occup_id', 'occup_id');
    }

    public function careerSteps(): HasMany
    {
        return $this->hasMany(CareerSteps::class, 'occup_id', 'occup_id');
    }
}
