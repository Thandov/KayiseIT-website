<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $status = $this->isCollectingEnquiries()
            ? 'enquiry'
            : ($this->isActivelyRunning() ? 'running' : 'active');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'program_type' => $this->program_type,
            'description' => $this->description,
            'duration' => $this->duration,
            'status' => $status,
            'allows_enquiry' => (bool) $this->allows_enquiry,
            'recruitment_start_date' => optional($this->recruitment_start_date)->toDateString(),
            'recruitment_end_date' => optional($this->recruitment_end_date)->toDateString(),
            'number_needed' => $this->number_needed,
            'has_stipend' => (bool) $this->has_stipend,
            'stipend_amount' => $this->when($this->has_stipend, $this->stipend_amount),
            'stipend_currency' => $this->when($this->has_stipend, $this->stipend_currency),
            'has_accreditation' => (bool) $this->has_accreditation,
            'accreditation_details' => $this->when(
                $request->routeIs('api.v1.programs.show'),
                $this->accreditation_details
            ),
            'requirements' => $this->when(
                $request->routeIs('api.v1.programs.show'),
                $this->requirements
            ),
            'youth_beneficiaries' => (bool) $this->youth_beneficiaries,
            'sponsors_partners' => $this->sponsors_partners ?? [],
            'image_url' => $this->image_url,
            'gallery_urls' => $this->gallery_urls,
            'partner' => $this->whenLoaded('partner', function () {
                if (! $this->partner) {
                    return null;
                }

                return [
                    'id' => $this->partner->id,
                    'name' => $this->partner->name,
                    'logo_url' => $this->partner->logo_url,
                    'website_url' => $this->partner->website_url,
                ];
            }),
            'url' => $this->allows_enquiry
                ? url('/programs')
                : url('/opportunities'),
        ];
    }
}
