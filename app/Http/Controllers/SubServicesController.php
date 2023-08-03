<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Subservice;
use App\Models\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SubServicesService;



class SubServicesController extends Controller
{
    private $subServicesService;

    public function __construct(SubServicesService $subServicesService)
    {
        $this->subServicesService = $subServicesService;
    }

    public function index($id)
    {
        $service = Service::find($id);
        return view('admin/services/addsubservices', compact('service'));
    }

    public function store(Request $request, $id)
    {
        //Input Validations
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'nullable|string',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
        ]);

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
        $service = Service::where('service_id', $request->service_id)->first();
        $subService = $this->subServicesService->storeSubservice($request, $service->service_id);

        return redirect()->route('admin.services.viewservice', ['id' => $id])->with(['status' => 'Subservice Added', 'subserv_id' => $subService->id]);
    }
    public function updateSubservice(Request $request, $id)
    {
        //input validations
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id' => 'required|exists:subservices,id',
        ]);

        $subservice = Subservice::find($id);
        $subservice->name = $request->name;
        $subservice->price = $request->price;
        $subservice->save();

        return redirect()->back()->with('success', 'Subservice updated successfully.');
    }

    public function update(Request $request, $id)
    {
        //input validations
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id' => 'required|exists:subservices,id',
        ]);

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