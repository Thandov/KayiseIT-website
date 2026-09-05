<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()
            ->orderBy('name')
            ->paginate($this->perPage($request));

        return ServiceResource::collection($services);
    }

    public function show(string $slug)
    {
        $slug = urldecode($slug);
        $underscore = str_replace('-', '_', $slug);

        $service = Service::query()
            ->where(function ($q) use ($slug, $underscore) {
                $q->where('slug', $slug)->orWhere('slug', $underscore);
            })
            ->with('subservices')
            ->firstOrFail();

        return new ServiceResource($service);
    }

    protected function perPage(Request $request): int
    {
        return min(max((int) $request->query('per_page', 15), 1), 50);
    }
}
