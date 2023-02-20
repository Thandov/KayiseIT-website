<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubserviceOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'subservice_id', 'name', 'price'
    ];

    protected $table = 'subservice_options';

    public function subservice()
    {
        return $this->belongsTo(Subservice::class);
    }
}
