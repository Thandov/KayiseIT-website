<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Subservice;
use App\Models\Options;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Helpers\RespondingHelper;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ServicesController extends Controller
{
    public function services()
    {
        $services = Service::all();
        return view('services', compact('services'));
    }

    public function newaddservice()
    {
        return view('admin/newaddservice');
    }

    public function store(Request $request)
    {
        try {
            $price = ($request->input('service_type') === 'dynamic') ? 0 : $request->input('price');

            $service = new Service;
            $service->id = $request->id;
            $service->name = $request->name;
            $service->slug = strtolower(str_replace(" ", "_", $request->name));
            $service->description = $request->description;
            $service->service_type = $request->service_type;
            $service->price = $price;
            $service->service_id = Str::random(8); // generate a random 8-character string
            while (Service::where('service_id', $service->service_id)->exists()) {
                $service->service_id = Str::random(8); // ensure uniqueness
            }
            
            $service->save();

            $this->ensureServiceBladeExists($service->name);

            return redirect()->route('dashboard.services.viewservice', ['id' => $service->id])
                ->with('success', 'Service created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create service: ' . $e->getMessage());
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

    public function display_service_name($slug)
    {
        $slug = urldecode($slug);
        // Try lookup: DB stores slug with underscores (e.g. cloud_hosting_services)
        $nameWithUnderscores = str_replace('-', '_', $slug);
        $service = DB::table('services')->where('slug', $nameWithUnderscores)->first();

        if (!$service) {
            // Also try hyphenated (in case slug was stored with hyphens)
            $service = DB::table('services')->where('slug', $slug)->first();
        }

        if (!$service) {
            abort(404, 'Service not found');
        }

        $subservices = Subservice::where('service_id', $service->service_id)->get();
        $result = [];

        foreach ($subservices as $subservice) {
            $options = Options::where('subservice_id', $subservice->subserv_id)->get();
            $optionsArray = [];

            foreach ($options as $option) {
                $optionArray = [
                    'unq_id' => $option->unq_id,
                    'subservice_id' => $option->subservice_id,
                    'name' => $option->name,
                    'quantified' => $option->quantified,
                    'price' => $option->price,
                ];
                $optionsArray[] = $optionArray;
            }
            $subserviceArray = [
                'subservice_name' => $subservice->name,
                'subserv_id' => $subservice->subserv_id,
                'price' => $subservice->price,
                'icon' => $subservice->icon,
                'options' => $optionsArray,
            ];

            $result[] = $subserviceArray;
        }

        $services = [
            'service' => $service->name,
            'subservices' => $result,
        ];
        // Return the 'viewservice' view with 'services' variable
        return view('viewservice', compact('services'));
    }


    public function updateService(Request $request)
    {
        try {
            $id = $request->input('id');
            $service = Service::where('service_id', $id)->first();

            if (!$service) {
                // Try finding by id if service_id doesn't work
                $service = Service::find($id);
            }

            if (!$service) {
                return redirect()->back()
                    ->with('error', 'Service not found.');
            }
            
            $price = ($request->input('service_type') === 'dynamic') ? 0 : $request->input('price');
            $service->name = $request->input('name');
            $service->price = $price;
            $service->service_type = $request->input('service_type');
            $service->description = $request->input('description');
            
            // Update slug if name changed
            $newSlug = strtolower(str_replace(" ", "_", $request->input('name')));
            if ($service->slug !== $newSlug) {
                $service->slug = $newSlug;
            }
            
            $service->save();

            $this->ensureServiceBladeExists($service->name);

            return redirect()->route('dashboard.services.viewservice', ['id' => $service->id])
                ->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $id = (int)$id;
            $service = Service::find($id);
            
            if (!$service) {
                return redirect()->route('dashboard.services')
                    ->with('error', 'Service not found.');
            }
            
            $serviceName = $service->name;
            $service->delete();
            
            return redirect()->route('dashboard.services')
                ->with('success', 'Service "' . $serviceName . '" deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.services')
                ->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }

    public function footer()
    {
        $services = Service::all();
        View::share('services', $services);
    }

    /**
     * Ensure a blade component exists for the service so the frontend service page works.
     * Creates a generic component in resources/views/components/services/ if one does not exist.
     */
    protected function ensureServiceBladeExists(string $serviceName): void
    {
        $componentName = Str::slug($serviceName);
        $viewNameFlat = 'components.' . $componentName;
        $viewNameSubfolder = 'components.services.' . $componentName;

        if (view()->exists($viewNameSubfolder) || view()->exists($viewNameFlat)) {
            return;
        }

        $servicesComponentsPath = resource_path('views/components/services');
        if (!File::isDirectory($servicesComponentsPath)) {
            File::makeDirectory($servicesComponentsPath, 0755, true);
        }
        $bladePath = $servicesComponentsPath . DIRECTORY_SEPARATOR . $componentName . '.blade.php';

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
