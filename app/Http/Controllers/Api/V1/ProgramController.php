<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProgramResource;
use App\Models\InternshipProgram;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = InternshipProgram::query()
            ->active()
            ->with('partner');

        $status = $request->query('status');

        if ($status === 'enquiry') {
            $query->collectingEnquiries();
        } elseif ($status === 'running') {
            $query->activelyRunning();
        } elseif ($status === 'recruiting') {
            $query->currentlyRecruiting()->orderBy('recruitment_end_date');
        } else {
            $query->orderBy('name');
        }

        $programs = $query->paginate($this->perPage($request));

        return ProgramResource::collection($programs);
    }

    public function show(int $id)
    {
        $program = InternshipProgram::query()
            ->active()
            ->with('partner')
            ->where('id', $id)
            ->firstOrFail();

        return new ProgramResource($program);
    }

    protected function perPage(Request $request): int
    {
        return min(max((int) $request->query('per_page', 15), 1), 50);
    }
}
