<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\SubService;
use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\View;


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
        $request->validate([
            'icon' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

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
    $service = Service::find($id);
    $subservices = SubService::where('service_id', $service->service_id)->get();
    return view('viewservice', compact('service', 'subservices'));
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->save();
        $subservices = $service->subservices;
    
        // Loop through each subservice and update its attributes
        foreach ($subservices as $index => $subservice) {
            $subservice->name = $request->input('subname')[$index];
            $subservice->price = $request->input('subprice')[$index];
            $subservice->save();
        }
    
        return redirect()->route('admin.services', $id)->with('success', 'Service updated successfully');
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