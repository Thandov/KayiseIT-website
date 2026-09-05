<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $isShow = $request->routeIs('api.v1.clients.show');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'display_name' => $this->displayName(),
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'status' => $this->status ?: 'lead',
            'status_label' => $this->statusLabel(),
            'inquiry_subject' => $this->inquiry_subject,
            'inquiry_message' => $this->when($isShow, $this->inquiry_message),
            'address' => $this->when($isShow, $this->address),
            'province' => $this->when($isShow, $this->province),
            'user_id' => $this->when($isShow, $this->user_id),
            'converted_at' => optional($this->converted_at)->toIso8601String(),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
