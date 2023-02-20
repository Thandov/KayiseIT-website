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





    public function storing(Request $request, $id)
{
    $service = Service::find($id);
    $service_id = $service->id;
    $names = $request->subservice_name_;
    $descriptions = $request->subservice_description_;
    $pricetype = $request->subservice_price_type_;
    $price = $request->subservice_price_;

    $option_names = $request->subservice_option_name_;
    $option_prices = $request->subservice_option_price_;

    for ($i = 0; $i < count($names); $i++) {
        $subService = new SubService();
        $subService->name = $names[$i];
        $subService->service_id = $service_id;
        $subService->description = $descriptions[$i];
        $subService->price_type = $pricetype[$i];

        if ($pricetype[$i] === 'dynamic') {
            
            $option_name = [];
            $option_price = [];

$j = 0;
while (isset($option_names[$i]) && isset($option_prices[$i])) {
    $option_name[] = ['name' => $option_names[$i]];
    $option_price[] = ['price' => $option_prices[$i]];
    $i++;
}


$subService->option_name = json_encode($option_name);
$subService->option_price = json_encode($option_price);

        } else {
            $subService->price = $price[$i];
        }

        $subService->save();
    }

    return redirect()->route('newaddservice.storing', $service->id)->with('status', 'Subservices added successfully.');
}




/*

public function storing(Request $request, $id)
{
    $service = Service::find($id);
    $service_id = $service->id;
    $names = $request->subservice_name_;
    $descriptions = $request->subservice_description_;
    $pricetype = $request->subservice_price_type_;
    $price = $request->subservice_price_;

    for ($i = 0; $i < count($names); $i++) {
        $subService = new SubService();
        $subService->name = $names[$i];
        $subService->service_id = $service_id;
        $subService->description = $descriptions[$i];
        $subService->price_type = $pricetype[$i];
        $subService->price = $price[$i];
        $subService->save();
    
        if ($pricetype[$i] === "dynamic" && $subService->service_id === $service_id) {
            $optionnames = $request->subservice_option_name_ ?? [];
            $optionprices = $request->subservice_option_price_ ?? [];
    
            for ($j = 0; $j < count($optionnames); $j++) {
                if (!empty($optionnames[$j]) && !empty($optionprices[$j])) {
                    $subservice_option = new SubserviceOption();
                    $subservice_option->name = $optionnames[$j];
                    $subservice_option->price = $optionprices[$j];
                    $subservice_option->subservice_id = $subService->id;
                    $subservice_option->save();
                }
            }
        }
    }
    

    return redirect()->route('newaddservice.storing', $service->id)->with('status', 'Subservices added successfully.');
}

*/
    



    /* 
    public function storing(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $subservices = [];
    
        $subserviceCounter = 0;
        while ($request->has("subservice_name_" . $subserviceCounter)) {
            $subserviceName = $request->input("subservice_name_" . $subserviceCounter);
            $subserviceDescription = $request->input("subservice_description_" . $subserviceCounter);
            $subservicePriceType = $request->input("subservice_price_type_" . $subserviceCounter);
            $subservicePrice = $request->input("subservice_price_" . $subserviceCounter);
    
            $subservice = new Subservice;
            $subservice->name = $subserviceName;
            $subservice->description = $subserviceDescription;
            $subservice->price_type = $subservicePriceType;
    
            if ($subservicePriceType === 'static') {
                $subservice->price = $subservicePrice;
            } else {
                $options = [];
                $optionCounter = 0;
                while ($request->has("subservice_option_name_" . $subserviceCounter . "_" . $optionCounter)) {
                    $optionName = $request->input("subservice_option_name_" . $subserviceCounter . "_" . $optionCounter);
                    $optionPrice = $request->input("subservice_option_price_" . $subserviceCounter . "_" . $optionCounter);

                    $subservice_option = new SubserviceOption;
                    $subservice_option->name = $optionName;
                    $subservice_option->price = $optionPrice;
                    $subservice_option->save();
                    $options[] = $subservice_option;
                    $optionCounter++;
                }
                $optionsArray = array_map(function ($subservice_option) {
                    return $subservice_option->toArray();
                }, $options);
                
                $subservice->options()->delete();
                    // ...
    foreach ($optionsArray as $option) {
        $subservice->options()->create($option);
    }
    // ...



            }
    
            $subservices[] = $subservice;
            $subserviceCounter++;
        }

        $subservicesArray = array_map(function ($subservice) {
            return $subservice->toArray();
        }, $subservices);
        
        $service->subservices()->delete();
        $service->subservices()->createMany($subservicesArray);
        
    
        return redirect()->route('newaddservice.storing', $service->id)->with('status', 'Subservices added successfully.');
    }
    

    
*/


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
    public function destroy(Request $request, $subservice_id)
{
   // find the subservice
   $subservice = SubService::find($subservice_id);

   // delete the subservice
   $subservice->delete();

   // redirect back to the view service page
   return redirect()->route('admin.viewservice')->with('success', 'Service updated successfully');
}


}
