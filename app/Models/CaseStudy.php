<?php

namespace App\Models;

use App\Support\CaseStudyTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    use HasFactory;

    protected $table = 'case_studies';

    protected $fillable = [
        'title',
        'slug',
        'headline',
        'image',
        'hyperlink',
        'has_gallery',
        'problem',
        'solution',
        'results',
        'results_list',
        'quote',
        'quote_name',
        'quote_role',
        'client_name',
        'sector',
        'type',
        'type_meta',
        'year',
        'duration',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'results_list' => 'array',
        'type_meta' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'has_gallery' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted()
    {
        static::saving(function (CaseStudy $caseStudy) {
            if (empty($caseStudy->slug)) {
                $caseStudy->slug = static::uniqueSlug($caseStudy->title, $caseStudy->id);
            }

            if ($caseStudy->type) {
                $caseStudy->sector = CaseStudyTypes::badge($caseStudy->type);
            }
        });
    }

    public function galleryImages()
    {
        return $this->hasMany(CaseStudyImage::class)->orderBy('order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('is_featured')->orderBy('order')->orderByDesc('created_at');
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'case-study';
        $slug = $base;
        $i = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn (Builder $query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    public function resolvedType(): string
    {
        $type = (string) ($this->type ?: '');

        return in_array($type, CaseStudyTypes::keys(), true) ? $type : CaseStudyTypes::WEBSITE;
    }

    public function typeLabel(): string
    {
        return CaseStudyTypes::label($this->resolvedType());
    }

    public function typeBadge(): string
    {
        return CaseStudyTypes::badge($this->resolvedType());
    }

    public function metaValue(string $key, $default = null)
    {
        $meta = $this->type_meta ?? [];

        return $meta[$key] ?? $default;
    }

    public function publicHeadline(): string
    {
        return $this->headline ?: $this->title;
    }

    public function imageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        }

        return asset(ltrim($this->image, '/'));
    }

    /**
     * Cover for cards/modal: uploaded image, else a type-matched site photo.
     */
    public function coverImageUrl(): string
    {
        if ($url = $this->imageUrl()) {
            return $url;
        }

        $fallbacks = [
            CaseStudyTypes::WEBSITE => 'images/landing-page/banner.jpeg',
            CaseStudyTypes::SOFTWARE => 'images/landing-page/banner2.jpg',
            CaseStudyTypes::TRAINING => 'images/skills2.jpeg',
            CaseStudyTypes::INFRASTRUCTURE => 'images/server_bae.png',
            CaseStudyTypes::REPAIR => 'images/techician.png',
            CaseStudyTypes::SUPPORT => 'images/KayiseIT-Team.jpg',
        ];

        $path = $fallbacks[$this->resolvedType()] ?? 'images/KayiseIT-Team.jpg';

        return asset($path);
    }

    public function toPublicCardArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'headline' => $this->publicHeadline(),
            'client' => $this->client_name,
            'sector' => $this->typeBadge(),
            'type' => $this->resolvedType(),
            'year' => $this->year,
            'duration' => $this->duration,
            'image' => $this->coverImageUrl(),
            'problem' => $this->problem,
            'solution' => $this->solution,
            'results' => $this->results,
            'resultItems' => $this->resultItems(),
            'quote' => $this->quote,
            'quoteName' => $this->quote_name,
            'quoteRole' => $this->quote_role,
            'hyperlink' => $this->hyperlink,
            'typeMeta' => $this->type_meta ?? [],
            'showUrl' => route('case-studies.show', $this->slug),
            'contactUrl' => route('contact', ['ref' => $this->slug]),
        ];
    }

    public static function plainMetric($text): string
    {
        return trim(html_entity_decode(strip_tags((string) $text), ENT_QUOTES, 'UTF-8'));
    }

    public function resultItems(): array
    {
        $list = $this->results_list ?? [];

        return array_values(array_filter(array_map(function ($item) {
            $text = is_array($item) ? ($item['text'] ?? '') : (string) $item;

            return static::plainMetric($text);
        }, $list)));
    }

    public function primaryResult(): ?string
    {
        $items = $this->resultItems();

        return $items[0] ?? null;
    }

    public function snapshotStats(): array
    {
        $stats = [];

        foreach (array_slice($this->resultItems(), 0, 3) as $item) {
            $stats[] = ['label' => 'Result', 'value' => strip_tags($item)];
        }

        if ($this->duration) {
            $stats[] = ['label' => 'Duration', 'value' => $this->duration];
        }

        if ($this->year) {
            $stats[] = ['label' => 'Year', 'value' => $this->year];
        }

        return array_slice($stats, 0, 4);
    }

    public function relatedPublished(int $limit = 2)
    {
        return static::query()
            ->published()
            ->where('id', '!=', $this->id)
            ->ordered()
            ->limit($limit)
            ->get();
    }
}
