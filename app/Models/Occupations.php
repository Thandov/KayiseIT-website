<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupations extends Model
{
    use HasFactory;
    protected $table = 'occupations';
    protected $primaryKey = 'occup_id'; //To make sure the PK is found By the controller or blade 
}
