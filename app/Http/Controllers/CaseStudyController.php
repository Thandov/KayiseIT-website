<?php

namespace App\Http\Controllers;

use App\Helpers\ImageOptimizer;
use App\Models\CaseStudy;
use App\Models\CaseStudyImage;
use App\Services\WebsiteScreenshotService;
use App\Support\CaseStudyTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CaseStudyController extends Controller
{
    public function publicIndex()
    {
        $allCaseStudies = CaseStudy::query()->published()->ordered()->get();
        $featured = $allCaseStudies->firstWhere('is_featured', true);
        $caseStudies = $allCaseStudies
            ->when($featured, fn ($collection) => $collection->where('id', '!=', $featured->id))
            ->values();
        $modalStudies = $allCaseStudies->map->toPublicCardArray()->values();
        $openStudy = request()->query('study');

        return view('case-studies.index', compact('caseStudies', 'featured', 'modalStudies', 'openStudy'))->with([
            'metaTitle' => 'Case Studies - Proof of completed work | KAYISE IT',
            'metaDescription' => 'Read how KAYISE IT solved real client problems in software, training, and infrastructure — with named clients and measurable results.',
            'metaKeywords' => 'KAYISE IT case studies, IT project results, software development South Africa, skills training outcomes',
        ]);
    }

    public function publicShow(string $slug)
    {
        $caseStudy = CaseStudy::query()
            ->published()
            ->where('slug', $slug)
            ->with('galleryImages')
            ->firstOrFail();

        $related = $caseStudy->relatedPublished(2);

        return view('case-studies.show', compact('caseStudy', 'related'))->with([
            'metaTitle' => $caseStudy->publicHeadline().' | KAYISE IT case study',
            'metaDescription' => \Illuminate\Support\Str::limit(strip_tags($caseStudy->results ?: $caseStudy->problem), 155),
            'metaKeywords' => collect([$caseStudy->client_name, $caseStudy->sector, 'KAYISE IT case study'])->filter()->join(', '),
        ]);
    }

    public function index(Request $request)
    {
        $query = CaseStudy::query()->orderBy('order')->orderByDesc('created_at');

        if ($search = trim((string) $request->query('q', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('headline', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($type = $request->query('type')) {
            if (in_array($type, CaseStudyTypes::keys(), true)) {
                $query->where('type', $type);
            }
        }

        if ($request->query('status') === 'active') {
            $query->where('is_active', true);
        } elseif ($request->query('status') === 'inactive') {
            $query->where('is_active', false);
        }

        if ($request->query('featured') === '1') {
            $query->where('is_featured', true);
        }

        $caseStudies = $query->paginate(10)->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $caseStudies->getCollection()->map(fn (CaseStudy $study) => $this->adminListItem($study))->values(),
                'meta' => [
                    'current_page' => $caseStudies->currentPage(),
                    'last_page' => $caseStudies->lastPage(),
                    'per_page' => $caseStudies->perPage(),
                    'total' => $caseStudies->total(),
                    'from' => $caseStudies->firstItem(),
                    'to' => $caseStudies->lastItem(),
                ],
            ]);
        }

        $isAdmin = true;
        $pageTitle = 'Case Studies Management';
        $typeOptions = CaseStudyTypes::options();

        return view('admin.dashboard.case-studies.index-wrapper', compact('caseStudies', 'isAdmin', 'pageTitle', 'typeOptions'));
    }

    public function toggleActive(Request $request, $id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        $caseStudy->is_active = ! $caseStudy->is_active;
        $caseStudy->save();
        Cache::forget('sitemap.xml');

        return response()->json([
            'success' => true,
            'is_active' => (bool) $caseStudy->is_active,
            'message' => $caseStudy->is_active ? 'Published on website.' : 'Unpublished.',
        ]);
    }

    public function toggleFeatured(Request $request, $id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        $caseStudy->is_featured = ! $caseStudy->is_featured;
        $caseStudy->save();

        return response()->json([
            'success' => true,
            'is_featured' => (bool) $caseStudy->is_featured,
            'message' => $caseStudy->is_featured ? 'Marked featured.' : 'Removed from featured.',
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        $caseStudy->delete();
        Cache::forget('sitemap.xml');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Case study deleted successfully.',
            ]);
        }

        return redirect()->route('dashboard.case-studies.index')
            ->with('success', 'Case study deleted successfully.');
    }

    private function adminListItem(CaseStudy $study): array
    {
        return [
            'id' => $study->id,
            'title' => $study->title,
            'client_name' => $study->client_name,
            'year' => $study->year,
            'type' => $study->resolvedType(),
            'type_label' => $study->typeLabel(),
            'is_active' => (bool) $study->is_active,
            'is_featured' => (bool) $study->is_featured,
            'image' => $study->coverImageUrl(),
            'slug' => $study->slug,
            'site_url' => ($study->slug && $study->is_active) ? route('case-studies.show', $study->slug) : null,
            'show_url' => route('dashboard.case-studies.show', $study->id),
            'edit_url' => route('dashboard.case-studies.edit', $study->id),
            'destroy_url' => route('dashboard.case-studies.destroy', $study->id),
            'toggle_active_url' => route('dashboard.case-studies.toggle-active', $study->id),
            'toggle_featured_url' => route('dashboard.case-studies.toggle-featured', $study->id),
        ];
    }

    public function create()
    {
        $isAdmin = true;
        $pageTitle = 'Create Case Study';

        return view('admin.dashboard.case-studies.create', compact('isAdmin', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $this->normalizeSlugInput($request);
        $validatedData = $this->validatedPayload($request);
        $validatedData = $this->applyFlags($request, $validatedData);
        $validatedData = $this->applyTypeFields($request, $validatedData);
        $validatedData = $this->applyImage($request, $validatedData);
        $validatedData = $this->applyScreenshotCapture($request, $validatedData);
        $validatedData['results_list'] = $this->resultsListFromRequest($request);
        $validatedData['slug'] = $this->resolvedSlug($request->input('slug'), $request->input('title'));

        $caseStudy = CaseStudy::create($validatedData);
        $this->storeGalleryImages($request, $caseStudy, 0);
        $this->syncGalleryFlag($caseStudy);
        Cache::forget('sitemap.xml');

        return redirect()->route('dashboard.case-studies.index')
            ->with('success', 'Case study created successfully.');
    }

    public function show($id)
    {
        $caseStudy = CaseStudy::with('galleryImages')->findOrFail($id);
        $isAdmin = true;
        $pageTitle = 'View Case Study';

        return view('admin.dashboard.case-studies.show', compact('caseStudy', 'isAdmin', 'pageTitle'));
    }

    public function edit($id)
    {
        $caseStudy = CaseStudy::with('galleryImages')->findOrFail($id);
        $isAdmin = true;
        $pageTitle = 'Edit Case Study';

        return view('admin.dashboard.case-studies.edit', compact('caseStudy', 'isAdmin', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $caseStudy = CaseStudy::findOrFail($id);

        $this->normalizeSlugInput($request);
        $validatedData = $this->validatedPayload($request, $caseStudy->id);
        $validatedData = $this->applyFlags($request, $validatedData);
        $validatedData = $this->applyTypeFields($request, $validatedData);
        $validatedData = $this->applyImage($request, $validatedData, $caseStudy);
        $validatedData = $this->applyScreenshotCapture($request, $validatedData, $caseStudy);
        $validatedData['results_list'] = $this->resultsListFromRequest($request);
        $validatedData['slug'] = $this->resolvedSlug($request->input('slug'), $request->input('title'), $caseStudy->id);

        $caseStudy->update($validatedData);

        if ($request->boolean('remove_cover') && ! $request->hasFile('image')) {
            $this->deletePublicImage($caseStudy->image);
            $caseStudy->update(['image' => null]);
        }

        if ($request->hasFile('gallery_images')) {
            $this->storeGalleryImages($request, $caseStudy, $caseStudy->galleryImages()->count());
        }

        if ($request->has('delete_gallery_images')) {
            foreach ($request->delete_gallery_images as $imageId) {
                $galleryImage = CaseStudyImage::find($imageId);
                if ($galleryImage && $galleryImage->case_study_id == $caseStudy->id) {
                    $this->deletePublicImage($galleryImage->image_path);
                    $galleryImage->delete();
                }
            }
        }

        $this->syncGalleryFlag($caseStudy);
        Cache::forget('sitemap.xml');

        return redirect()->route('dashboard.case-studies.index')
            ->with('success', 'Case study updated successfully.');
    }

    private function normalizeSlugInput(Request $request): void
    {
        $slug = trim((string) $request->input('slug', ''));
        $request->merge(['slug' => $slug !== '' ? Str::slug($slug) : null]);
    }

    private function validatedPayload(Request $request, ?int $ignoreId = null): array
    {
        $type = (string) $request->input('type', CaseStudyTypes::WEBSITE);
        $urlRequired = $type === CaseStudyTypes::WEBSITE;

        return $request->validate([
            'type' => ['required', 'string', Rule::in(CaseStudyTypes::keys())],
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:case_studies,slug,'.($ignoreId ?? 'NULL').',id',
            'headline' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:8192',
            'hyperlink' => [Rule::requiredIf($urlRequired), 'nullable', 'url', 'max:500'],
            'capture_screenshot' => 'nullable|boolean',
            'has_gallery' => 'nullable|boolean',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:8192',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'results' => 'nullable|string',
            'quote' => 'nullable|string',
            'quote_name' => 'nullable|string|max:255',
            'quote_role' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'duration' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'type_meta' => 'nullable|array',
            'type_meta.tech_stack' => 'nullable|string|max:255',
            'type_meta.before_url' => 'nullable|url|max:500',
            'type_meta.platform' => 'nullable|string|max:100',
            'type_meta.product_name' => 'nullable|string|max:255',
            'type_meta.demo_url' => 'nullable|url|max:500',
            'type_meta.partners' => 'nullable|string|max:500',
            'type_meta.cohort_size' => 'nullable|string|max:50',
            'type_meta.completion_rate' => 'nullable|string|max:50',
            'type_meta.employment_rate' => 'nullable|string|max:50',
            'type_meta.programme_dates' => 'nullable|string|max:100',
            'type_meta.location' => 'nullable|string|max:255',
            'type_meta.scope' => 'nullable|array',
            'type_meta.scope.*' => 'nullable|string|max:50',
            'type_meta.device_type' => 'nullable|string|max:50',
            'type_meta.fault_category' => 'nullable|string|max:50',
            'type_meta.turnaround' => 'nullable|string|max:100',
            'type_meta.sla_tier' => 'nullable|string|max:100',
            'type_meta.tickets_before' => 'nullable|string|max:50',
            'type_meta.tickets_after' => 'nullable|string|max:50',
            'type_meta.response_time' => 'nullable|string|max:100',
            'type_meta.contract_duration' => 'nullable|string|max:100',
        ]);
    }

    private function applyTypeFields(Request $request, array $validatedData): array
    {
        $type = $validatedData['type'] ?? CaseStudyTypes::WEBSITE;
        $validatedData['type'] = $type;
        $validatedData['type_meta'] = CaseStudyTypes::normalizeMeta($type, $request->input('type_meta', []));
        $validatedData['sector'] = CaseStudyTypes::badge($type);

        if (! in_array($type, [CaseStudyTypes::WEBSITE, CaseStudyTypes::SOFTWARE], true)) {
            $validatedData['hyperlink'] = null;
        }

        unset($validatedData['capture_screenshot']);

        return $validatedData;
    }

    private function applyScreenshotCapture(Request $request, array $validatedData, ?CaseStudy $existing = null): array
    {
        if (! $request->boolean('capture_screenshot')) {
            return $validatedData;
        }

        if (($validatedData['type'] ?? '') !== CaseStudyTypes::WEBSITE) {
            return $validatedData;
        }

        if ($request->hasFile('image')) {
            return $validatedData;
        }

        $url = $validatedData['hyperlink'] ?? $existing?->hyperlink;
        if (! $url) {
            return $validatedData;
        }

        $path = app(WebsiteScreenshotService::class)->capture($url, 'cover');
        if (! $path) {
            return $validatedData;
        }

        if ($existing && $existing->image) {
            $this->deletePublicImage($existing->image);
        }

        $validatedData['image'] = $path;

        return $validatedData;
    }

    private function applyFlags(Request $request, array $validatedData): array
    {
        $validatedData['is_featured'] = $request->has('is_featured');
        $validatedData['is_active'] = $request->has('is_active');

        return $validatedData;
    }

    private function applyImage(Request $request, array $validatedData, ?CaseStudy $existing = null): array
    {
        if (! $request->hasFile('image')) {
            unset($validatedData['image']);

            return $validatedData;
        }

        if ($existing && $existing->image) {
            $this->deletePublicImage($existing->image);
        }

        $validatedData['image'] = $this->storeOptimizedImage(
            $request->file('image'),
            'images/case-studies',
            'cover_'.time()
        );

        return $validatedData;
    }

    private function resultsListFromRequest(Request $request): array
    {
        $resultsList = [];
        foreach ($request->input('results_list', []) as $result) {
            $text = CaseStudy::plainMetric($result['text'] ?? '');
            if ($text !== '') {
                $resultsList[] = ['text' => $text];
            }
        }

        return $resultsList;
    }

    private function resolvedSlug(?string $slug, string $title, ?int $ignoreId = null): string
    {
        $source = $slug ?: $title;

        return CaseStudy::uniqueSlug(Str::slug($source) ?: $title, $ignoreId);
    }

    private function storeGalleryImages(Request $request, CaseStudy $caseStudy, int $startOrder): void
    {
        if (! $request->hasFile('gallery_images')) {
            return;
        }

        foreach ($request->file('gallery_images') as $index => $galleryImage) {
            $path = $this->storeOptimizedImage(
                $galleryImage,
                'images/case-studies/gallery',
                'gallery_'.time().'_'.($startOrder + $index)
            );
            CaseStudyImage::create([
                'case_study_id' => $caseStudy->id,
                'image_path' => $path,
                'order' => $startOrder + $index,
            ]);
        }
    }

    private function storeOptimizedImage($image, string $folder, string $filename): string
    {
        $relative = ImageOptimizer::optimize($image, $folder, [
            'filename' => $filename,
            'max_width' => 1600,
            'max_height' => 1200,
            'quality' => 85,
            'format' => 'auto',
        ]);

        return '/'.ltrim($relative, '/');
    }

    private function deletePublicImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        $relative = ltrim(str_replace('/storage/', '', $path), '/');
        $publicFile = public_path($relative);
        if (is_file($publicFile)) {
            @unlink($publicFile);
        }

        $storageKey = str_replace('/storage/', 'public/', $path);
        if (Storage::exists($storageKey)) {
            Storage::delete($storageKey);
        }
    }

    private function syncGalleryFlag(CaseStudy $caseStudy): void
    {
        $caseStudy->has_gallery = $caseStudy->galleryImages()->exists();
        $caseStudy->saveQuietly();
    }
}
