<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternsLearner extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'program_id',
        'first_name',
        'middle_name',
        'surname',
        'email',
        'phone',
        'id_number',
        'date_of_birth',
        'gender',
        'address',
        'status',
        'start_date',
        'end_date',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationships
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /** @deprecated Use person() */
    public function internshipApplication()
    {
        return $this->person();
    }

    public function program()
    {
        return $this->belongsTo(InternshipProgram::class, 'program_id');
    }

    /**
     * Relationship-like helper for MICT beneficiary.
     *
     * Note: this is not used with Eloquent eager loading (with()),
     * but is accessed as a computed attribute: $internLearner->mict_beneficiary
     */
    public function getMictBeneficiaryAttribute()
    {
        if (!$this->program_id || !$this->email) {
            return null;
        }

        return MictBeneficiary::where('email_address', $this->email)
            ->where('program_id', $this->program_id)
            ->first();
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
