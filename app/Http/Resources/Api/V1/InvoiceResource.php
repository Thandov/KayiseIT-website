<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Items;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $isShow = $request->routeIs('api.v1.invoices.show');

        return [
            'id' => $this->id,
            'invoice_no' => $this->invoice_no,
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
            'vat' => $this->vat,
            'total_vat' => $this->total_vat,
            'items' => $this->when($isShow, function () {
                return Items::query()
                    ->where('QI_id', $this->invoice_no)
                    ->get()
                    ->map(fn (Items $item) => [
                        'id' => $item->id,
                        'name' => $item->name,
                        'qty' => $item->qty ?? $item->quantity ?? null,
                        'price' => $item->price ?? null,
                        'sub_total' => $item->sub_total ?? null,
                    ])
                    ->values();
            }),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
