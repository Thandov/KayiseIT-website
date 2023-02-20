<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\SubService;
use Illuminate\Http\Request;
use stdClass;

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
    $subservices = SubService::where('service_id', $id)->get();
    return view('viewservice', compact('service', 'subservices'));
}

public function updateService(Request $request, $id)
{
    $service = Service::findOrFail($id);
    $service->name = $request->input('name');
    $service->description = $request->input('description');
    $service->save();

    foreach ($request->input('subservices') as $subserviceId => $subserviceData) {
        $subservice = Subservice::findOrFail($subserviceId);
        $subservice->name = $subserviceData['name'];
        $subservice->description = $subserviceData['description'];

        if ($subservice->price_type === 'dynamic') {
            $optionName = [];
            $optionPrice = [];

            foreach ($subserviceData['option_name'] as $key => $value) {
                if (!empty($value)) {
                    $optionName[] = ['name' => $value];
                }

                if (!empty($subserviceData['option_price'][$key])) {
                    $optionPrice[] = ['price' => $subserviceData['option_price'][$key]];
                }
            }

            $subservice->option_name = json_encode($optionName);
            $subservice->option_price = json_encode($optionPrice);
        } else {
            $subservice->price = $subserviceData['price'];
        }

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





    
}