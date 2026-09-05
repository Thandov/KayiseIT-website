<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Safe staff card — no ID numbers, personal email, DOB, address, or document paths.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $user = $this->relationLoaded('user') ? $this->user : null;
        $accountStatus = 'none';
        if ($user) {
            $accountStatus = $user->email_verified_at ? 'active' : 'pending';
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'initials' => $this->initials,
            'job_title' => $this->job_title,
            'job_title_id' => $this->job_title_id,
            'email' => $this->email,
            'phone' => $this->phone,
            'province' => $this->province,
            'manager_id' => $this->manager_id,
            'sort_order' => $this->sort_order,
            'photo_url' => $this->photo_url,
            'account_status' => $accountStatus,
            'assigned_title' => $this->whenLoaded('assignedTitle', function () {
                if (! $this->assignedTitle) {
                    return null;
                }

                return [
                    'id' => $this->assignedTitle->id,
                    'name' => $this->assignedTitle->name,
                    'slug' => $this->assignedTitle->slug ?? null,
                ];
            }),
            'manager' => $this->when(
                $request->routeIs('api.v1.staff.show') && $this->relationLoaded('manager'),
                function () {
                    if (! $this->manager) {
                        return null;
                    }

                    return [
                        'id' => $this->manager->id,
                        'full_name' => $this->manager->full_name,
                    ];
                }
            ),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
