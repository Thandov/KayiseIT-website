<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsinaRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'id_number',
        'contact',
        'email',
        'address',
        'dob',
        'unemployed',
        'youth',
        'highest_qualification',
        'own_business',
        'id_upload_path',
    ];
}


