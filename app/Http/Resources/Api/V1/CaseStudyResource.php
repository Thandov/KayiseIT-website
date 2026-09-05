<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseStudyResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $isShow = $request->routeIs('api.v1.case-studies.show');

        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'headline' => $this->publicHeadline(),
            'client_name' => $this->client_name,
            'sector' => $this->typeBadge(),
            'type' => $this->resolvedType(),
            'year' => $this->year,
            'duration' => $this->duration,
            'is_featured' => (bool) $this->is_featured,
            'image_url' => $this->coverImageUrl(),
            'hyperlink' => $this->hyperlink,
            'problem' => $this->when($isShow, $this->problem),
            'solution' => $this->when($isShow, $this->solution),
            'results' => $this->when($isShow, $this->results),
            'result_items' => $this->resultItems(),
            'quote' => $this->when($isShow, $this->quote),
            'quote_name' => $this->when($isShow, $this->quote_name),
            'quote_role' => $this->when($isShow, $this->quote_role),
            'type_meta' => $this->when($isShow, $this->type_meta ?? []),
            'gallery' => $this->whenLoaded('galleryImages', function () {
                return $this->galleryImages->map(fn ($image) => [
                    'url' => $image->url(),
                    'order' => $image->order,
                ])->values();
            }),
            'url' => route('case-studies.show', $this->slug),
            'contact_url' => route('contact', ['ref' => $this->slug]),
        ];
    }
}
