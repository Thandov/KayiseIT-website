<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subservice extends Model
{
    use HasFactory;

    protected $fillable = ['subserv_id', 'service_id', 'name', 'slug', 'icon', 'subservice_type', 'price'];


    protected $table = 'subservices';

    public function options()
    {
        return $this->hasMany(SubserviceOption::class);
    }
}
