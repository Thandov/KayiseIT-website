<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'dob',
        'gender',
        'age',
        'highest_level',
        'School_name',
        'number',
        'address',
        'guardian_name',
        'relation',
        'guardian_number',
        'guardian_email',
        'guardian_address',
        'kin_name',
        'kin_relation',
        'kin_number',
        'course',
        'paid',
        'payment_date',
        'status',
    ];
}
