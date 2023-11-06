<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery_groups';

    protected $fillable = ['name', 'user_id', 'description'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo('App\Models\Gallery');
        return $this->belongsTo(User::class);
    }
}
