<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends ApiController
{
    public function index(Request $request)
    {
        $this->authorizeDashboard($request);

        $invoices = Invoice::query()
            ->orderByDesc('created_at')
            ->paginate($this->perPage($request));

        return InvoiceResource::collection($invoices);
    }

    public function show(Request $request, int $id)
    {
        $this->authorizeDashboard($request);

        $invoice = Invoice::query()->where('id', $id)->firstOrFail();

        return new InvoiceResource($invoice);
    }
}
