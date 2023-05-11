<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Subservice;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class ServicesController extends Controller
{
    public function services()
    {
        $services = Service::all();
        return view('services', compact('services'));
    }


    public function addservice()
    {
        return view('admin/addservice');
    }

    public function newaddservice()
    {
        return view('admin/newaddservice');
    }

    public function store(Request $request)
    {


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

    public function show($id)
    {
        $testimonials = Testimonial::all();
        $service = Service::find($id);
        $subservices = Subservice::where('service_id', $service->service_id)->get();
        return view('viewservice', compact('service', 'subservices', 'testimonials'));
    }

    public function display_service_name($slug)
    {
        $name = str_replace('-', ' ', ucwords($slug, '-'));
        $service = DB::table('services')->where('name', $name)->get()->first();
        $subservices = Subservice::where('service_id', $service->service_id)->get();
        // Return the blade file corresponding to the slug with the service and name data
        return view('viewservice', compact('service', 'subservices'));
    }

    public function updateService(Request $request, $id)
    {

        dd($id);
        $service = Service::findOrFail($id);
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->save();

        $subservices = $request->input('subservices');
        foreach ($subservices as $subserviceId => $subserviceData) {
            $subservice = Subservice::findOrFail($subserviceId);
            $subservice->name = $subserviceData['name'];
            $subservice->price = $subserviceData['price'];
            $subservice->save();
        }

        return redirect()->back();
    }


    public function delete($id)
    {
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