<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientApiController extends ApiController
{
    public function index(Request $request)
    {
        $this->authorizeClients($request);

        $query = Client::query()->orderByDesc('updated_at');

        $status = $request->query('status');
        if ($status === Client::STATUS_LEAD) {
            $query->leads();
        } elseif ($status === Client::STATUS_CLIENT) {
            $query->converted();
        }

        return ClientResource::collection($query->paginate($this->perPage($request)));
    }

    public function show(Request $request, int $id)
    {
        $this->authorizeClientsRead($request);

        $client = Client::query()->where('id', $id)->firstOrFail();

        return new ClientResource($client);
    }
}
