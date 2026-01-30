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
        $name = str_replace('-', '_', $slug);
        $service = DB::table('services')->where('slug', $name)->first();

        if (!$service) {
            // Handle the case where the service with the given slug doesn't exist
            return 'Service not found';
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
}
