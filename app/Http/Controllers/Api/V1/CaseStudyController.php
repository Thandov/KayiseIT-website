<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CaseStudyResource;
use App\Models\CaseStudy;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    public function index(Request $request)
    {
        $caseStudies = CaseStudy::query()
            ->published()
            ->ordered()
            ->paginate($this->perPage($request));

        return CaseStudyResource::collection($caseStudies);
    }

    public function show(string $slug)
    {
        $caseStudy = CaseStudy::query()
            ->published()
            ->where('slug', $slug)
            ->with('galleryImages')
            ->firstOrFail();

        return new CaseStudyResource($caseStudy);
    }

    protected function perPage(Request $request): int
    {
        return min(max((int) $request->query('per_page', 15), 1), 50);
    }
}
