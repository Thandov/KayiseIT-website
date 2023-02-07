<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SubServices;
use App\Models\SubService;
use App\Models\SubServiceOption;
use Illuminate\Http\Request;
use App\Http\Controllers\ServicesController;

class SubServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $service = Service::find($id);
        return view('admin/services/newaddservice', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'description' => 'required|max:255',
    ]);

    $subService = new SubService([
        'service_id' => $request->get('service_id'),
        'name' => $request->get('name'),
        'price' => $request->get('price'),
        'description' => $request->get('description'),
    ]);
    $subService->save();

    return redirect('/sub_services')->with('success', 'Sub Service created!');
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
     /*   $service = Service::find($id);
        
        $subService = new SubServices();
        //$subService->service_id = session()->get('service_id');
        $subService->name = $request->name;
        $subService->service_id = $service->id;
        $subService->description = $request->description;
        $subService->price = $request->price;
        $subService->save();
*/
$service = Service::find($id);
    $service_id = $service->id;
    $names = $request->name;
    $descriptions = $request->description;
    $prices = $request->price;

    for($i=0; $i<count($names); $i++)
    {
        $subService = new SubServices();
        $subService->name = $names[$i];
        $subService->service_id = $service_id;
        $subService->description = $descriptions[$i];
        $subService->price = $prices[$i];
        $subService->save();
    } 
        
        return redirect('admin/services')->with('status', 'Sub Service Added');
    }




    
/*
    public function storing(Request $request, $id)
    {
        $service = Service::find($id);

        $subservices = [];
        foreach ($request->input() as $inputName => $inputValue) {
            if (strpos($inputName, 'subservice_name') === 0) {
                $subserviceIndex = explode('_', $inputName)[3];
                $subservice = [
                    'name' => $inputValue,
                    'description' => $request->input("subservice_description_" . $subserviceIndex),
                    'price_type' => $request->input("subservice_price_type_" . $subserviceIndex),
                    'price' => $request->input("subservice_price_" . $subserviceIndex),
                ];

                if ($subservice['price_type'] === 'dynamic') {
                    $subservice['options'] = [];
                    $subserviceOptionIndex = 0;
                    while ($request->has("subservice_option_name_" . $subserviceIndex . "_" . $subserviceOptionIndex)) {
                        $subservice['options'][] = [
                            'name' => $request->input("subservice_option_name_" . $subserviceIndex . "_" . $subserviceOptionIndex),
                            'price' => $request->input("subservice_option_price_" . $subserviceIndex . "_" . $subserviceOptionIndex),
                        ];
                        $subserviceOptionIndex++;
                    }
                }
                $subservices[] = $subservice;
            }
        }

        foreach ($subservices as $subservice) {
            $newSubService = new SubService;
            $newSubService->name = $subservice['name'];
            $newSubService->description = $subservice['description'];
            $newSubService->price_type = $subservice['price_type'];
            $newSubService->price = $subservice['price'];
            $newSubService->service_id = $service->id;
            $newSubService->save();

            if ($subservice['price_type'] === 'dynamic') {
                foreach ($subservice['options'] as $option) {
                    $newOption = new SubServiceOption;
                    $newOption->name = $option['name'];
                    $newOption->price = $option['price'];
                    $newOption->sub_service_id = $newSubService->id;
                    $newOption->save();
                }
            }
        }

        return redirect()->route('newaddservice.storing', $service->id)->with('status', 'Subservices added successfully.');
    } */

    public function storing(Request $request, $id)
{
    $service = Service::find($id);

    if (!$service) {
        return redirect()->back()->with('error', 'Service not found');
    }

    $subserviceData = $request->validate([
        'name*' => 'required',
        'description*' => 'required',
        'price_type*' => 'required',
    ]);

    $subservices = [];
    foreach ($subserviceData as $key => $value) {
        if (strpos($key, 'name_') === 0) {
            $index = str_replace('name_', '', $key);
            $subservices[$index]['name'] = $value;
            $subservices[$index]['description'] = $subserviceData['description' . $index];
            $subservices[$index]['price_type'] = $subserviceData['price_type' . $index];
            if ($subservices[$index]['price_type'] === 'static') {
                $subservices[$index]['price'] = $subserviceData['price' . $index];
            } else {
                $options = [];
                for ($i = 0; true; $i++) {
                    if (!isset($subserviceData['option_name' . $index . '_' . $i])) {
                        break;
                    }
                    $options[] = [
                        'name' => $subserviceData['option_name' . $index . '_' . $i],
                        'price' => $subserviceData['option_price' . $index . '_' . $i],
                    ];
                }
                $subservices[$index]['options'] = $options;
            }
        }
    }

    foreach ($subservices as $subservice) {
        $service->subservices()->create([
            'name' => $subservice['name'],
            'description' => $subservice['description'],
            'price_type' => $subservice['price_type'],
            'price' => $subservice['price'] ?? null,
            'options' => $subservice['options'] ?? null,
        ]);
    }
    return redirect()->route('newaddservice.storing', $service->id)->with('status', 'Service added successfully!');
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function show(SubService $subService)
    {
        return view('sub_services.show', compact('subService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function edit(SubService $subService)
    {
        return view('sub_services.edit', compact('subService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubService $subService)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'description' => 'required|max:255',
    ]);

    $subService->service_id = $request->get('service_id');
    $subService->name = $request->get('name');
    $subService->price = $request->get('price');
    $subService->description = $request->get('description');
    $subService->save();

    return redirect('/sub_services')->with('success', 'Sub Service updated!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubService $subService)
{
    $subService->delete();

    return redirect('/sub_services')->with('success', 'Sub Service deleted!');
}

}
