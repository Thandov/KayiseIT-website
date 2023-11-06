<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPhotos extends Model
{
    use HasFactory;

    protected $table = "group_photo";

    protected $fillable = ['group_id', 'photo_id'];
}
