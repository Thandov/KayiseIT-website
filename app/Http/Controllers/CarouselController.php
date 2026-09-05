<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Carousel;
use App\Support\SlideTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::query()
            ->latest()
            ->paginate(10);
        $isAdmin = true;

        return view('admin/dashboard/carousel/index', compact('carousels', 'isAdmin'));
    }

    public function create()
    {
        $isAdmin = true;
        $blogs = $this->blogOptions();
        $templates = SlideTemplates::all();

        return view('admin/dashboard/carousel/create', compact('isAdmin', 'blogs', 'templates'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validatedSlide($request, true);

            $carousel = new Carousel();
            $this->fillSlide($carousel, $validated, $request);
            $carousel->user_id = Auth::id();
            $carousel->save();

            if ($request->ajax()) {
                return response()->json(['message' => 'Slide created successfully.']);
            }

            return redirect()
                ->route('admin.dashboard.carousel')
                ->with('success', 'Slide created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function show($id)
    {
        $carousel = Carousel::findOrFail($id);
        $isAdmin = true;

        return view('admin/dashboard/carousel/show', compact('carousel', 'isAdmin'));
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        $isAdmin = true;
        $blogs = $this->blogOptions();
        $templates = SlideTemplates::all();

        return view('admin/dashboard/carousel/edit', compact('carousel', 'isAdmin', 'blogs', 'templates'));
    }

    public function update(Request $request, $id)
    {
        try {
            $carousel = Carousel::findOrFail($id);
            $validated = $this->validatedSlide($request, false);
            $this->fillSlide($carousel, $validated, $request);
            $carousel->user_id = Auth::id();
            $carousel->save();

            return redirect()
                ->route('admin.dashboard.carousel')
                ->with('success', 'Slide updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $carousel = Carousel::findOrFail($id);

            if ($carousel->image && Storage::disk('public')->exists(ltrim($carousel->image, '/'))) {
                Storage::disk('public')->delete(ltrim($carousel->image, '/'));
            }

            $carousel->delete();

            if ($request->ajax()) {
                return response()->json(['message' => 'Slide deleted successfully.']);
            }

            return redirect()->route('admin.dashboard.carousel')->with('success', 'Slide deleted successfully.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Slide not found.'], 404);
            }

            return redirect()->route('admin.dashboard.carousel')->with('error', 'Slide not found.');
        }
    }

    protected function blogOptions()
    {
        try {
            return Blog::query()
                ->select('id', 'title', 'created_at')
                ->orderByDesc('created_at')
                ->get();
        } catch (\Throwable $e) {
            return collect();
        }
    }

    protected function validatedSlide(Request $request, bool $isCreate): array
    {
        $template = $request->input('template', SlideTemplates::CLASSIC);
        $copyRequired = $template === SlideTemplates::CLASSIC;

        return $request->validate([
            'template' => ['required', Rule::in(SlideTemplates::keys())],
            'head_title' => ['required', 'string', 'max:255'],
            'middletxt' => [$copyRequired ? 'required' : 'nullable', 'string', 'max:255'],
            'btmtxt' => [$copyRequired ? 'required' : 'nullable', 'string', 'max:255'],
            'profile_picture' => [
                $isCreate ? 'required' : 'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:8192',
            ],
            'link_type' => ['required', Rule::in(['none', 'services', 'blog', 'custom'])],
            'blog_id' => ['nullable', 'required_if:link_type,blog', 'exists:blogs,id'],
            'cta_url' => ['nullable', 'required_if:link_type,custom', 'url', 'max:500'],
            'cta_label' => ['nullable', 'string', 'max:80'],
        ], [
            'head_title.required' => 'Give this slide a name. It is used in the dashboard and as the image label.',
            'profile_picture.required' => 'Upload a slide image.',
            'blog_id.required_if' => 'Choose the blog post this slide should open.',
            'cta_url.required_if' => 'Enter the URL this slide should open.',
            'middletxt.required' => 'Classic slides need a headline.',
            'btmtxt.required' => 'Classic slides need a supporting line.',
        ]);
    }

    protected function fillSlide(Carousel $carousel, array $validated, Request $request): void
    {
        $carousel->template = $validated['template'];
        $carousel->title = $validated['head_title'];
        $carousel->middletxt = $validated['middletxt'] ?? null;
        $carousel->btmtxt = $validated['btmtxt'] ?? null;
        $carousel->link_type = $validated['link_type'];
        $carousel->cta_label = $validated['cta_label'] ?? null;
        $carousel->blog_id = $validated['link_type'] === 'blog' ? ($validated['blog_id'] ?? null) : null;
        $carousel->cta_url = $validated['link_type'] === 'custom' ? ($validated['cta_url'] ?? null) : null;

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $file = $request->file('profile_picture');
            $name = Str::uuid()->toString().'.'.strtolower($file->getClientOriginalExtension());

            $file->storeAs('images/carousel', $name, 'public');
            $carousel->image = '/images/carousel/'.$name;
        }
    }
}
