<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery_groups';

    protected $fillable = ['name', 'user_id', 'description', 'featured_on_homepage'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photos::class, 'group_photo', 'group_id', 'photo_id');
    }
}
