<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Carousel;
use App\Support\SlideTemplates;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogCarouselSyncService
{
    public function sync(Blog $blog, bool $asSlide, ?int $userId = null): void
    {
        if (! $asSlide) {
            $this->deleteAllSlidesForBlog($blog);

            return;
        }

        $slide = Carousel::query()
            ->where('blog_id', $blog->id)
            ->where('from_blog', true)
            ->first()
            ?? Carousel::query()->where('blog_id', $blog->id)->first()
            ?? new Carousel();

        $slide->from_blog = true;
        $slide->blog_id = $blog->id;
        $slide->link_type = 'blog';
        $slide->template = SlideTemplates::CAMPAIGN;
        $slide->title = $blog->title;
        $slide->middletxt = $blog->title;
        $slide->btmtxt = $blog->subtitle;
        $slide->cta_label = 'Read the story';
        $slide->cta_url = null;

        if ($userId) {
            $slide->user_id = $userId;
        }

        $this->syncImage($blog, $slide);

        if (! filled($slide->image)) {
            throw new \RuntimeException('This post needs an image before it can be a carousel slide.');
        }

        $slide->save();
    }

    public function deleteFromBlogSlides(Blog $blog): void
    {
        Carousel::query()
            ->where('blog_id', $blog->id)
            ->where('from_blog', true)
            ->get()
            ->each(fn (Carousel $slide) => $this->deleteSlide($slide));
    }

    public function deleteAllSlidesForBlog(Blog $blog): void
    {
        Carousel::query()
            ->where('blog_id', $blog->id)
            ->get()
            ->each(fn (Carousel $slide) => $this->deleteSlide($slide));
    }

    protected function deleteSlide(Carousel $slide): void
    {
        $this->deleteCarouselImage($slide);
        $slide->delete();
    }

    protected function syncImage(Blog $blog, Carousel $slide): void
    {
        $source = $this->absolutePublicPath((string) $blog->icon);

        if (! $source) {
            return;
        }

        $existing = $this->absolutePublicPath((string) $slide->image);
        if ($existing && @md5_file($existing) === @md5_file($source)) {
            return;
        }

        $extension = strtolower(pathinfo($source, PATHINFO_EXTENSION) ?: 'jpg');
        $name = Str::uuid()->toString().'.'.$extension;
        $relative = 'images/carousel/'.$name;

        Storage::disk('public')->put($relative, file_get_contents($source));

        $this->deleteCarouselImage($slide);
        $slide->image = '/'.$relative;
    }

    protected function deleteCarouselImage(Carousel $slide): void
    {
        $path = ltrim((string) $slide->image, '/');

        if ($path === '' || ! str_contains($path, 'images/carousel/')) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function absolutePublicPath(string $path): ?string
    {
        $relative = ltrim(preg_replace('#^\.\./#', '', $path) ?? '', '/');

        if ($relative === '' || $relative === 'null') {
            return null;
        }

        $absolute = public_path($relative);

        if (is_file($absolute)) {
            return $absolute;
        }

        $storage = storage_path('app/'.$relative);

        return is_file($storage) ? $storage : null;
    }
}
