<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\Service;
use App\Models\ServiceTier;
use App\Models\Subservice;
use App\Models\Testimonial;
use App\Services\ServiceTierSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator as ValidatorInstance;

class ServicesController extends Controller
{
    public function __construct(
        protected ServiceTierSyncService $tierSync
    ) {
    }

    public function services()
    {
        $services = Service::all();

        return view('services', compact('services'));
    }

    public function newaddservice()
    {
        return view('admin/newaddservice');
    }

    public function createServiceForm()
    {
        $service = new Service;
        $tiersByKey = collect();

        return view('admin.services.addservice', compact('service', 'tiersByKey'));
    }

    public function store(Request $request)
    {
        $this->validateServiceTiers($request);

        try {
            DB::beginTransaction();

            $service = new Service;
            $service->name = $request->name;
            $service->slug = strtolower(str_replace(' ', '_', $request->name));
            $service->description = $request->input('description', '');
            $service->service_type = 'static';
            $service->price = 0;
            $service->service_id = Str::random(8);
            while (Service::where('service_id', $service->service_id)->exists()) {
                $service->service_id = Str::random(8);
            }
            $service->save();

            $this->tierSync->sync($service, $request);
            $this->ensureServiceBladeExists($service->name);

            DB::commit();

            return redirect()->route('dashboard.services.viewservice', ['id' => $service->id])
                ->with('success', 'Service created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create service: '.$e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $testimonials = Testimonial::all();
        $service = Service::find($id);
        $subservices = Subservice::where('service_id', $service->service_id)->get();
        $storedOptions = unserialize($request->session()->get('key'));

        return view('viewservice', compact('service', 'subservices', 'testimonials'));
    }

    /**
     * Legacy URL: redirect to Small tier page.
     */
    public function display_service_name(string $slug)
    {
        $slug = urldecode($slug);
        $service = $this->resolveServiceByUrlSlug($slug);
        if (! $service) {
            abort(404, 'Service not found');
        }

        return redirect()->route('service.show.tier', [
            'slug' => $service->publicSlug(),
            'tier' => ServiceTier::TIER_SMALL,
        ], 301);
    }

    public function displayServiceTier(string $slug, string $tier)
    {
        $slug = urldecode($slug);
        $service = $this->resolveServiceByUrlSlug($slug);
        if (! $service) {
            abort(404, 'Service not found');
        }

        $serviceTier = $service->tiers()
            ->where('tier_key', $tier)
            ->with(['page', 'tierPrice', 'packages.features', 'addons'])
            ->first();

        if (! $serviceTier) {
            abort(404, 'This tier is not available for this service.');
        }

        $servicesPayload = $this->buildPublicServicePayload($service);
        $publicSlug = $service->publicSlug();

        return view('service-tier', [
            'service' => $service,
            'serviceTier' => $serviceTier,
            'tierKey' => $tier,
            'services' => $servicesPayload,
            'publicSlug' => $publicSlug,
        ]);
    }

    protected function resolveServiceByUrlSlug(string $slug): ?Service
    {
        $underscore = str_replace('-', '_', $slug);

        return Service::query()
            ->where(function ($q) use ($slug, $underscore) {
                $q->where('slug', $slug)->orWhere('slug', $underscore);
            })
            ->first();
    }

    protected function buildPublicServicePayload(Service $service): array
    {
        $subservices = Subservice::where('service_id', $service->service_id)->get();
        $result = [];

        foreach ($subservices as $subservice) {
            $options = Options::where('subservice_id', $subservice->subserv_id)->get();
            $optionsArray = [];

            foreach ($options as $option) {
                $optionsArray[] = [
                    'unq_id' => $option->unq_id,
                    'subservice_id' => $option->subservice_id,
                    'name' => $option->name,
                    'quantified' => $option->quantified,
                    'price' => $option->price,
                ];
            }

            $result[] = [
                'subservice_name' => $subservice->name,
                'subserv_id' => $subservice->subserv_id,
                'price' => $subservice->price,
                'icon' => $subservice->icon,
                'options' => $optionsArray,
            ];
        }

        return [
            'service' => $service->name,
            'subservices' => $result,
        ];
    }

    public function updateService(Request $request)
    {
        $this->validateServiceTiers($request, true);

        try {
            $id = $request->input('id');
            $service = Service::where('service_id', $id)->first();

            if (! $service) {
                $service = Service::find($id);
            }

            if (! $service) {
                return redirect()->back()
                    ->with('error', 'Service not found.');
            }

            DB::beginTransaction();

            $service->name = $request->input('name');
            $service->description = $request->input('description');

            $newSlug = strtolower(str_replace(' ', '_', $request->input('name')));
            if ($service->slug !== $newSlug) {
                $service->slug = $newSlug;
            }

            $service->save();

            $this->tierSync->sync($service, $request);
            $this->ensureServiceBladeExists($service->name);

            DB::commit();

            return redirect()->route('dashboard.services.viewservice', ['id' => $service->id])
                ->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update service: '.$e->getMessage());
        }
    }

    protected function validateServiceTiers(Request $request, bool $isUpdate = false): void
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tier_small.amount' => 'nullable|numeric|min:0',
            'tier_small.label' => 'nullable|string|max:255',
            'tier_small.page.hero_heading' => 'nullable|string|max:255',
            'tier_small.page.hero_subheading' => 'nullable|string',
            'tier_small.page.body' => 'nullable|string',
            'tier_small.page.meta_title' => 'nullable|string|max:255',
            'tier_small.page.meta_description' => 'nullable|string',
            'tier_small.page.primary_cta_label' => 'nullable|string|max:255',
            'tier_small.page.primary_cta_href' => 'nullable|string|max:2048',
            'tier_medium.label' => 'nullable|string|max:255',
            'tier_medium.packages' => 'nullable|array',
            'tier_medium.packages.*.name' => 'nullable|string|max:255',
            'tier_medium.packages.*.price' => 'nullable|numeric|min:0',
            'tier_medium.packages.*.description' => 'nullable|string',
            'tier_medium.packages.*.features' => 'nullable|string',
            'tier_medium.addons' => 'nullable|array',
            'tier_medium.addons.*.name' => 'nullable|string|max:255',
            'tier_medium.addons.*.price' => 'nullable|numeric|min:0',
            'tier_medium.addons.*.pricing_type' => 'nullable|in:fixed,quantity',
            'tier_medium.addons.*.unit_label' => 'nullable|string|max:100',
            'tier_medium.addons.*.min_qty' => 'nullable|integer|min:0',
            'tier_medium.addons.*.max_qty' => 'nullable|integer|min:0',
            'tier_medium.page.hero_heading' => 'nullable|string|max:255',
            'tier_medium.page.hero_subheading' => 'nullable|string',
            'tier_medium.page.body' => 'nullable|string',
            'tier_medium.page.meta_title' => 'nullable|string|max:255',
            'tier_medium.page.meta_description' => 'nullable|string',
            'tier_medium.page.primary_cta_label' => 'nullable|string|max:255',
            'tier_medium.page.primary_cta_href' => 'nullable|string|max:2048',
            'tier_medium.page.sections_json' => 'nullable|string',
            'tier_enterprise.label' => 'nullable|string|max:255',
            'tier_enterprise.page.hero_heading' => 'nullable|string|max:255',
            'tier_enterprise.page.hero_subheading' => 'nullable|string',
            'tier_enterprise.page.body' => 'nullable|string',
            'tier_enterprise.page.meta_title' => 'nullable|string|max:255',
            'tier_enterprise.page.meta_description' => 'nullable|string',
            'tier_enterprise.page.primary_cta_label' => 'nullable|string|max:255',
            'tier_enterprise.page.primary_cta_href' => 'nullable|string|max:2048',
        ];

        if ($isUpdate) {
            $rules['id'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->after(function (ValidatorInstance $validator) use ($request) {
            $smallAmount = $request->input('tier_small.amount');
            $hasSmallPrice = $smallAmount !== null && $smallAmount !== ''
                && is_numeric($smallAmount) && (float) $smallAmount > 0;
            $packages = collect($request->input('tier_medium.packages', []))
                ->filter(fn ($p) => is_array($p) && ! empty($p['name']));
            $addons = collect($request->input('tier_medium.addons', []))
                ->filter(fn ($a) => is_array($a) && ! empty($a['name']));
            if ($packages->isEmpty() && $addons->isEmpty() && ! $hasSmallPrice) {
                $validator->errors()->add(
                    'tier_medium.packages',
                    'Provide a Small fixed price greater than 0, or add at least one Medium package or add-on.'
                );
            }
        });

        $validator->validate();
    }

    public function delete($id)
    {
        try {
            $id = (int) $id;
            $service = Service::find($id);

            if (! $service) {
                return redirect()->route('dashboard.services')
                    ->with('error', 'Service not found.');
            }

            $serviceName = $service->name;
            $service->delete();

            return redirect()->route('dashboard.services')
                ->with('success', 'Service "'.$serviceName.'" deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.services')
                ->with('error', 'Failed to delete service: '.$e->getMessage());
        }
    }

    public function footer()
    {
        $services = Service::all();
        View::share('services', $services);
    }

    protected function ensureServiceBladeExists(string $serviceName): void
    {
        $componentName = Str::slug($serviceName);
        $viewNameFlat = 'components.'.$componentName;
        $viewNameSubfolder = 'components.services.'.$componentName;

        if (view()->exists($viewNameSubfolder) || view()->exists($viewNameFlat)) {
            return;
        }

        $servicesComponentsPath = resource_path('views/components/services');
        if (! File::isDirectory($servicesComponentsPath)) {
            File::makeDirectory($servicesComponentsPath, 0755, true);
        }
        $bladePath = $servicesComponentsPath.DIRECTORY_SEPARATOR.$componentName.'.blade.php';

        $title = Str::title($serviceName);
        $content = <<<BLADE
<div class="container grid sm:grid-flow-row md:grid-cols-1 pb-4">
    <div class="px-4 mt-4">
        <x-titlestyle smheading="Transform Your" bgheading="{$title}!" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
        <p class="text-left">{{ \$service }} - We provide comprehensive solutions tailored to your business needs.</p>
        <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4 my-4">
            @foreach(\$subservices ?? [] as \$subservice)
            @php
            \$slug = str_replace(' ','-', strtolower(\$service));
            \$subslug = str_replace(' ','-', strtolower(\$subservice['subservice_name'] ?? ''));
            \$uniqueId = "subserv_card_" . \$subslug;
            @endphp
            <div class="subserv_card justify-center" id="{{ \$uniqueId }}" data-target="slide_{{\$subslug}}">
                <div class="overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex justify-center">
                        <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center">
                            @if(isset(\$subservice['icon']))
                            <img class="w-12" src="{{ asset('images/subservices/'.\$subservice['icon']) }}">
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <h2 class="mt-4 text-xl text-center font-bold smalltxt">{{ \$subservice['subservice_name'] ?? 'Subservice' }}</h2>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function highlightRow(checkbox) {
        const row = checkbox.closest('.grid');
        if (checkbox.checked) {
            row.classList.add('highlighted-row');
        } else {
            row.classList.remove('highlighted-row');
        }
    }
</script>
BLADE;

        File::put($bladePath, $content);
    }
}
