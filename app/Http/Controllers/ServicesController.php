<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function services()
    {
        $services = Service::all();
        return view('navbar.services', compact('services'));
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
            'logo' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '_' . $request->name . '.' . $request->logo->extension();

        $request->logo->move(public_path('images/service_logo'), $newImageName);
        

        $service = new Service;
        $service->name = $request->name;
        $service->id = $request->id;
        $service->description = $request->description;
        $service->logo = $newImageName;
        $service->save();
        return redirect()->route('newaddservice', ['id' => $service->id])->with(['status' => 'Service Added', 'service_id' => $service->id]);
    }

    public function show($id)
{
    $service = Service::find($id);
    $subservices = SubServices::where('service_id', $id)->get();
  return view('viewservice', compact('service', 'subservices'));
}

    
}