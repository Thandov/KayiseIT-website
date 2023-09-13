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
        // Custom validation messages for each field
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute field must be a string.',
            'max' => 'The :attribute field cannot be longer than :max characters.',
            'in' => 'The selected :attribute is invalid.',
            'numeric' => 'The :attribute field must be a number.',
            'image' => 'The :attribute must be an image.',
            'mimes' => 'The :attribute must be a file of type: :values.',
            'max' => 'The :attribute must not be greater than :max kilobytes.',
        ];

        // Validate the input data with custom messages
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|in:static,dynamic',
            'price' => 'required|numeric',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $customMessages);

        $newImageName = time() . '_' . $request->name . '.' . $request->icon->extension();
        $request->icon->move(public_path('images/service_logo'), $newImageName);

        $service = new Service;
        $service->id = $request->id;
        $service->icon = $newImageName;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->service_type = $request->service_type;
        $service->price = $request->price;
        $service->service_id = Str::random(8); // generate a random 8-character string
        while (Service::where('service_id', $service->service_id)->exists()) {
            $service->service_id = Str::random(8); // ensure uniqueness
        }
        $service->save();

        return redirect()->route('admin.services')->with('success', 'Service updated successfully');
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
            $options = Options::where('unq_id', $subservice->subserv_id)->get();

            $optionsArray = [];

            foreach ($options as $option) {
                $optionArray = [
                    'name' => $option->name,
                    'quantified' => $option->quantified,
                    'price' => $option->price,
                ];

                $optionsArray[] = $optionArray;
            }

            $subserviceArray = [
                'subservice_name' => $subservice->name,
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
        $id = $request->input('id');
        $service = Service::where('service_id', $id)->first();

        if (!$service) {
            return RespondingHelper::respond(null, 'Service not found', 'error', 'back');
        }
        $price = ($request->input('service_type') === 'dynamic') ? 0 : $request->input('price') ;
        $service->name = $request->input('name');
        $service->price = $price;
        $service->service_type = $request->input('service_type');
        $service->description = $request->input('description');
        $service->save();

        return RespondingHelper::respond($service, 'Service updated successfully', 'success', 'back');
    }

    public function delete($id)
    {
        dd("sdse");
        $id = (int)$id;
        $service = Service::find($id);
        $service->delete();
        return redirect()->back();
    }

    public function footer()
    {
        $services = Service::all();
        View::share('services', $services);
    }
}
