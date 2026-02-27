<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';

    /**
     * Views use $item->name; DB column is 'item'.
     */
    public function getNameAttribute()
    {
        return $this->attributes['item'] ?? '';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['item'] = $value;
    }
}
