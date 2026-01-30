<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'service_id',
        'icon',
        'name',
        'slug',
        'description',
        'service_type',
        'price',
    ];

    public function subservices()
    {
        return $this->hasMany(Subservice::class);
    }
}