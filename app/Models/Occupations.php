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
        'video_url',
        'image',
        'quiz_tags',
        'school_subjects',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'entry_salary_min' => 'integer',
        'entry_salary_max' => 'integer',
        'display_order' => 'integer',
        'school_subjects' => 'array',
    ];

    public function quizTagsList(): array
    {
        if (!$this->quiz_tags) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->quiz_tags))));
    }

    public function videoEmbedUrl(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        if (str_contains($this->video_url, 'youtube.com/embed') || str_contains($this->video_url, 'player.vimeo.com')) {
            return $this->video_url;
        }

        return null;
    }

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
