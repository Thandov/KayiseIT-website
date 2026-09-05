<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $cover = $this->coverUrl();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->when($request->routeIs('api.v1.blogs.show'), $this->content),
            'cover_url' => $cover ? url($cover) : null,
            'category' => $this->whenLoaded('category', function () {
                return $this->category ? [
                    'id' => $this->category->id,
                    'name' => $this->category->category_name,
                ] : null;
            }),
            'meta_title' => $this->when(
                $request->routeIs('api.v1.blogs.show'),
                $this->meta_title
            ),
            'meta_description' => $this->when(
                $request->routeIs('api.v1.blogs.show'),
                $this->meta_description
            ),
            'url' => url('/blogs/displayblog/'.$this->id),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
