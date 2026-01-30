<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MictBeneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_application_id',
        'program_id',
        'learner_title',
        'first_name',
        'middle_name',
        'surname',
        'maiden_name',
        'type_of_id',
        'id_number',
        'date_of_birth',
        'residence_status',
        'marital_status',
        'gender',
        'race',
        'disabled',
        'type_of_disability',
        'age',
        'sa_citizen',
        'nationality',
        'first_language',
        'employed',
        'length_of_unemployment_years',
        'employment_start_date',
        'learner_agreement_start_date',
        'learner_agreement_end_date',
        'program_start_date',
        'amount_allocated',
        'previous_internship',
        'year_of_study',
        'physical_address_1',
        'physical_address_2',
        'physical_address_3',
        'physical_postal_code',
        'postal_address_1',
        'postal_address_2',
        'postal_address_3',
        'postal_address_postal_code',
        'type_of_area',
        'email_address',
        'cellphone',
        'telephone',
        'fax',
        'highest_nqf_qualification',
        'other_qualification',
        'title_of_highest_qualification',
        'has_matriculated',
        'matriculated_in_sa',
        'province_of_high_school',
        'year_of_national_senior_certificate',
        'guardian_first_name',
        'guardian_last_name',
        'guardian_type_of_id',
        'guardian_id_number',
        'guardian_telephone',
        'guardian_cellphone',
        'guardian_home_address',
        'guardian_postal_address',
        'guardian_email_address',
    ];

    protected $casts = [
        'disabled' => 'boolean',
        'sa_citizen' => 'boolean',
        'employed' => 'boolean',
        'previous_internship' => 'boolean',
        'has_matriculated' => 'boolean',
        'matriculated_in_sa' => 'boolean',
        'date_of_birth' => 'date',
        'employment_start_date' => 'date',
        'learner_agreement_start_date' => 'date',
        'learner_agreement_end_date' => 'date',
        'program_start_date' => 'date',
        'amount_allocated' => 'decimal:2',
        'age' => 'integer',
        'length_of_unemployment_years' => 'integer',
    ];

    // Relationships
    public function internshipApplication()
    {
        return $this->belongsTo(InternshipApplication::class);
    }

    public function program()
    {
        return $this->belongsTo(InternshipProgram::class, 'program_id');
    }

    // Accessor for full name
    public function getFullNameAttribute()
    {
        $name = $this->first_name;
        if ($this->middle_name) {
            $name .= ' ' . $this->middle_name;
        }
        $name .= ' ' . $this->surname;
        return $name;
    }
}
