<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class AnnouncementResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $isShow = $request->routeIs('api.v1.announcements.show');
        $image = ltrim((string) ($this->image ?? ''), '/');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'badge' => $this->badge,
            'link' => $this->link,
            'image_url' => $image !== ''
                ? (Str::startsWith($image, ['http://', 'https://']) ? $this->image : asset($image))
                : null,
            'description' => $isShow
                ? $this->description
                : Str::limit(strip_tags((string) $this->description), 160),
            'message' => $this->when($isShow, $this->message),
            'is_active' => (bool) $this->is_active,
            'expires_at' => optional($this->expires_at)->toIso8601String(),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
