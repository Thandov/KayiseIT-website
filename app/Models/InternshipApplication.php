<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // Add other fillable fields
        'cv_path',
        'id_copy_path',
        'qualification_copy_path',
    ];
}
