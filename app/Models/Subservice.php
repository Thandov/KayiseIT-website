<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subservice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'service_id', 'description', 'price_type', 'price', 'options'];


    protected $table = 'subservices';

    public function options()
    {
        return $this->hasMany(SubserviceOption::class);
    }
}
