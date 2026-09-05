<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\AnnouncementResource;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementApiController extends ApiController
{
    public function index(Request $request)
    {
        $this->authorizeDashboard($request);

        $query = Announcement::query()->orderByDesc('created_at');

        if ($request->query('active') === '1') {
            $query->where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
                });
        }

        return AnnouncementResource::collection($query->paginate($this->perPage($request)));
    }

    public function show(Request $request, int $id)
    {
        $this->authorizeDashboard($request);

        $announcement = Announcement::query()->where('id', $id)->firstOrFail();

        return new AnnouncementResource($announcement);
    }
}
