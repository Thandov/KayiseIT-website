<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'user_id',
        'name',
        'email',
        'id_no',
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
    ];

    // Relationships
    public function internLearner()
    {
        return $this->hasOne(InternsLearner::class, 'internship_application_id');
    }

    public function mictBeneficiary()
    {
        return $this->hasOne(MictBeneficiary::class, 'internship_application_id');
    }
}
