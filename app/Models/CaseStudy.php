<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $table = 'case_studies';

    protected $fillable = [
        'title',
        'image',
        'hyperlink',
        'has_gallery',
        'problem',
        'solution',
        'results',
        'results_list',
        'client_name',
        'year',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'results_list' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'has_gallery' => 'boolean',
        'order' => 'integer',
    ];

    public function galleryImages()
    {
        return $this->hasMany(CaseStudyImage::class)->orderBy('order');
    }
}
