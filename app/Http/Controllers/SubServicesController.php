<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Subservice;
use App\Models\Options;
use App\Models\SubServiceOption;
use Illuminate\Http\Request;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class SubServicesController extends Controller
{
    public function index($id)
    {
        $service = Service::find($id);
        return view('admin/services/addsubservices', compact('service'));
    }


    public function store(Request $request, $id)
    {
        $service = Service::find($id);
        $service_id = $service->id;
        $names = $request->name;
        $descriptions = $request->description;
        $prices = $request->price;

        for ($i = 0; $i < count($names); $i++) {
            $subService = new Subservice();
            $subService->name = $names[$i];
            $subService->service_id = $service_id;
            $subService->description = $descriptions[$i];
            $subService->price = $prices[$i];
            $subService->save();
        }

        return redirect('admin/services')->with('status', 'Sub Service Added');
    }


    public function storing(Request $request, $id)
    {
        $service = Service::find($id);
        $id = $service->id;
        $service_id = $service->service_id;

        $request->validate(['icon' => 'required|mimes:svg,jpg,png,jpeg|max:5048']);
        $newImageName = $request->file('icon')->getClientOriginalName();
        $request->icon->move(public_path('images/subservices'), $newImageName);

        $subService = new Subservice();
        $subService->service_id = $service_id;
        $subService->name = $request->name;
        $subService->icon = $newImageName;
        $subService->subservice_type = $request->subservice_type;
        $subService->price = $request->price;
        $subService->subserv_id = Str::random(8); // generate a random 8-character string
        while (Subservice::where('subserv_id', $subService->subserv_id)->exists()) {
            $service->subserv_id = Str::random(8); // ensure uniqueness
        }
        $subService->save();
        return redirect()->route('admin.viewservice', ['id' => $id])->with(['status' => 'Subservice Added', 'subserv_id' => $subService->id]);
    }

    public function updateSubservice(Request $request, $id)
    {
        $subservice = Subservice::find($id);
        $subservice->name = $request->name;
        $subservice->price = $request->price;
        $subservice->save();

        return redirect()->back()->with('success', 'Subservice updated successfully.');
    }




    public function update(Request $request, $id)
    {
        $subservice = Subservice::findOrFail($id);
        $subservice->name = $request->name;
        $subservice->price = $request->price;
        $subservice->save();

        return redirect()->back()->with('success', 'Subservice updated successfully');
    }


    public function destroy(Request $request, $subservice_id)
    {
        // find the subservice
        $subservice = Subservice::find($subservice_id);

        // delete the subservice
        $subservice->delete();

        // redirect back to the view service page
        return redirect()->back()->with('success', 'User has been deleted!');
    }

    public function show($id)
    {
        $subservice = Subservice::find($id);
        $options = Options::where('unq_id', $subservice->subserv_id)->get();
        return view('services/sub_services/viewsubservice', compact('subservice', 'options'));
    }
    public function display_subservice_name($slug, $subslug)
    {
        $name = str_replace('-', ' ', ucwords($subslug, '-'));
        $subservice = DB::table('subservices')->where('name', $name)->get()->first();
        // Return the blade file corresponding to the slug with the service and name data
        $options = Options::where('unq_id', $subservice->subserv_id)->get();
        return view('services/sub_services/viewsubservice', compact('subservice', 'options'));
    }
}