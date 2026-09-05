<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->with('category')
            ->select('id', 'icon', 'title', 'subtitle', 'category_no', 'created_at', 'updated_at')
            ->orderByDesc('created_at')
            ->paginate($this->perPage($request));

        return BlogResource::collection($blogs);
    }

    public function show(int $id)
    {
        $blog = Blog::query()
            ->with('category')
            ->where('id', $id)
            ->firstOrFail();

        return new BlogResource($blog);
    }

    protected function perPage(Request $request): int
    {
        return min(max((int) $request->query('per_page', 15), 1), 50);
    }
}
