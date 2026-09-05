<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_study_id',
        'image_path',
        'order',
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudy::class);
    }

    public function url(): string
    {
        $path = ltrim((string) $this->image_path, '/');

        return asset($path);
    }
}
