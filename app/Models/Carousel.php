<?php

namespace App\Models;

use App\Support\SlideTemplates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;

class Carousel extends Model
{
    use HasFactory;

    protected $table = 'carousels';

    protected $fillable = [
        'user_id',
        'title',
        'middletxt',
        'btmtxt',
        'image',
        'template',
        'link_type',
        'blog_id',
        'from_blog',
        'cta_url',
        'cta_label',
    ];

    protected $casts = [
        'from_blog' => 'boolean',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function templateKey(): string
    {
        $key = (string) ($this->template ?? '');

        return in_array($key, SlideTemplates::keys(), true)
            ? $key
            : SlideTemplates::CLASSIC;
    }

    public function linkType(): string
    {
        $type = (string) ($this->link_type ?? '');

        return in_array($type, ['none', 'services', 'blog', 'custom'], true)
            ? $type
            : 'services';
    }

    public function destinationUrl(): ?string
    {
        return match ($this->linkType()) {
            'none' => null,
            'blog' => $this->blog_id && Route::has('blogs.displayblog')
                ? route('blogs.displayblog', $this->blog_id)
                : null,
            'custom' => $this->cta_url ?: null,
            default => Route::has('services') ? route('services') : url('/services'),
        };
    }

    public function destinationLabel(): ?string
    {
        if (! $this->destinationUrl()) {
            return null;
        }

        if (filled($this->cta_label)) {
            return $this->cta_label;
        }

        return match ($this->linkType()) {
            'blog' => 'Read the story',
            'custom' => 'Learn more',
            'none' => null,
            default => 'Explore services',
        };
    }

    public function templateMeta(): array
    {
        return SlideTemplates::all()[$this->templateKey()];
    }
}
