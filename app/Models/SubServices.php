<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServices extends Model
{
    use HasFactory;
    protected $table = 'sub_services';
    protected $fillable = [
        'name', 'description', 'price', 'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
