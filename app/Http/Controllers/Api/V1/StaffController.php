<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\StaffResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class StaffController extends ApiController
{
    public function index(Request $request)
    {
        $this->authorizeDashboard($request);

        $staff = Employee::query()
            ->with(['user', 'assignedTitle'])
            ->orderBy('sort_order')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate($this->perPage($request));

        return StaffResource::collection($staff);
    }

    public function show(Request $request, int $id)
    {
        $this->authorizeDashboard($request);

        $employee = Employee::query()
            ->with(['user', 'assignedTitle', 'manager'])
            ->where('id', $id)
            ->firstOrFail();

        return new StaffResource($employee);
    }
}
