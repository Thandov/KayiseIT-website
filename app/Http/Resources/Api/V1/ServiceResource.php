<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $icon = ltrim((string) ($this->icon ?? ''), '/');

        return [
            'id' => $this->id,
            'service_id' => $this->service_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'public_slug' => $this->publicSlug(),
            'description' => $this->description,
            'service_type' => $this->service_type,
            'icon_url' => $icon !== '' ? asset('images/service_logo/'.$icon) : null,
            'url' => url('/services/'.$this->publicSlug()),
            'subservices' => $this->whenLoaded('subservices', function () {
                return $this->subservices->map(function ($sub) {
                    $icon = ltrim((string) ($sub->icon ?? ''), '/');

                    return [
                        'subserv_id' => $sub->subserv_id,
                        'name' => $sub->name,
                        'price' => $sub->price,
                        'icon_url' => $icon !== '' ? asset('images/subservices/'.$icon) : null,
                    ];
                })->values();
            }),
        ];
    }
}
