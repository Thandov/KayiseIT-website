<?php

namespace App\Models;

use App\Services\BlogCarouselSyncService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected static function booted(): void
    {
        static::deleting(function (Blog $blog) {
            app(BlogCarouselSyncService::class)->deleteAllSlidesForBlog($blog);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategories::class, 'category_no');
    }

    public function coverUrl(): ?string
    {
        $icon = ltrim((string) $this->icon, '/');

        if ($icon === '' || $icon === 'null') {
            return null;
        }

        return '/'.$icon;
    }

    public function carouselSlide(): HasOne
    {
        return $this->hasOne(Carousel::class);
    }

    public function carouselSlides(): HasMany
    {
        return $this->hasMany(Carousel::class);
    }

    public function isCarouselSlide(): bool
    {
        if ($this->relationLoaded('carouselSlide')) {
            return $this->carouselSlide !== null;
        }

        if ($this->relationLoaded('carouselSlides')) {
            return $this->carouselSlides->isNotEmpty();
        }

        return $this->carouselSlides()->exists();
    }
}
