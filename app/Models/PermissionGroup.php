<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PermissionGroup extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_group_permission',
            'permission_group_id',
            'permission_id'
        );
    }

    public function jobTitles(): BelongsToMany
    {
        return $this->belongsToMany(
            JobTitle::class,
            'job_title_permission_group',
            'permission_group_id',
            'job_title_id'
        );
    }
}
