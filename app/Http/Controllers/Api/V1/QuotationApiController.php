<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\QuotationResource;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationApiController extends ApiController
{
    public function index(Request $request)
    {
        $this->authorizeDashboard($request);

        $quotations = Quotation::query()
            ->orderByDesc('created_at')
            ->paginate($this->perPage($request));

        return QuotationResource::collection($quotations);
    }

    public function show(Request $request, int $id)
    {
        $this->authorizeDashboard($request);

        $quotation = Quotation::query()->where('id', $id)->firstOrFail();

        return new QuotationResource($quotation);
    }
}
