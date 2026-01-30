<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $table = 'quotations';

    public function subservices()
    {
        return $this->belongsToMany(Subservice::class)->withPivot('option_name', 'option_price', 'price');
    }
    public function options()
{
    return $this->hasMany(Option::class);
}

}
