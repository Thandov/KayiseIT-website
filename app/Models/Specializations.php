<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    use HasFactory;
    protected $table = 'specializations';
    protected $primaryKey = 'spec_id'; //To make sure the PK is found By the controller or blade 
}
