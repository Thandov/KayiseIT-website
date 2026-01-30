<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSteps extends Model
{
    use HasFactory;
    protected $table = 'career_steps';
    protected $primaryKey = 'steps_id';
}
