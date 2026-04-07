<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $casts = [
        'responded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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
        'internship_program_id',
        'program_partner',
        'status',
        'cv_path',
        'id_copy_path',
        'qualification_copy_path',
        'admin_message',
        'responded_at',
        'responded_by',
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

    public function internshipProgram()
    {
        return $this->belongsTo(InternshipProgram::class, 'internship_program_id');
    }
}
