<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public string $heroId;

    public ?string $title;

    public ?string $subtitle;

    public ?string $description;

    public ?string $backgroundImage;

    public Collection $carouselSlides;

    public bool $showLogo;

    public bool $showCta;

    public string $ctaText;

    public string $ctaHref;

    public string $height;

    public function __construct(
        string $heroId = 'page-header',
        ?string $title = null,
        ?string $subtitle = null,
        ?string $description = null,
        ?string $backgroundImage = null,
        $carouselSlides = null,
        bool $showLogo = false,
        bool $showCta = false,
        string $ctaText = 'Contact us: info@kayiseit.com',
        string $ctaHref = 'mailto:info@kayiseit.com',
        string $height = 'h-96',
    ) {
        $this->heroId = $heroId;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
        $this->backgroundImage = $backgroundImage;
        $this->carouselSlides = $carouselSlides instanceof Collection
            ? $carouselSlides
            : collect($carouselSlides ?? []);
        $this->showLogo = $showLogo;
        $this->showCta = $showCta;
        $this->ctaText = $ctaText;
        $this->ctaHref = $ctaHref;
        $this->height = $height;
    }

    public function render()
    {
        return view('components.page-header');
    }
}
