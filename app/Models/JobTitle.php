<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JobTitle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $title) {
            if (blank($title->slug) && filled($title->name)) {
                $title->slug = Str::slug($title->name);
            }
        });
    }

    public function permissionGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            PermissionGroup::class,
            'job_title_permission_group',
            'job_title_id',
            'permission_group_id'
        )->orderBy('display_name');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function groupLabels(): string
    {
        $this->loadMissing('permissionGroups');

        return $this->permissionGroups
            ->pluck('display_name')
            ->filter()
            ->implode(', ');
    }
}
