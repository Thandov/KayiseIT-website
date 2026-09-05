<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'live_url',
        'github_url',
        'gitlab_url',
        'bitbucket_url',
        'other_platform_label',
        'other_platform_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
