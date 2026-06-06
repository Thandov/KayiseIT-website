<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'id_number',
        'email',
        'cellphone',
        'country',
        'province',
        'location_type',
        'location_name',
        'internship_program_id',
        'source',
    ];

    public function program()
    {
        return $this->belongsTo(InternshipProgram::class, 'internship_program_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->name.' '.$this->surname);
    }

    public function getLocationTypeLabelAttribute(): string
    {
        return $this->location_type === 'township' ? 'Township' : 'Town';
    }
}
