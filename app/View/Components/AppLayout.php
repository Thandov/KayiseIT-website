<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public string $title;

    public function __construct(
        ?string $title = null,
        public ?string $description = null,
        public ?string $keywords = null,
        public bool $noindex = false,
        public ?string $ogImage = null,
    ) {
        $this->title = $title ?? (string) config('app.name', 'KAYISE IT');
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $isAdmin = request()->is('dashboard*') || request()->is('admin/*');

        return view('layouts.app', [
            'isAdmin' => $isAdmin,
            'metaTitle' => $this->title,
            'metaDescription' => $this->description,
            'metaKeywords' => $this->keywords,
            'metaNoindex' => $this->noindex,
            'metaOgImage' => $this->ogImage,
        ]);
    }
}
