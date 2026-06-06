<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'icon',
        'title',
        'subtitle',
        'content',
        'category_no',
        'meta_title',
        'meta_description',
    ];
}
