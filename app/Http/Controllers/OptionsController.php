<?php

namespace App\Http\Controllers;

use App\Models\SubService;
use App\Models\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OptionsController extends Controller
{
    public function options($id){
        $subservice = SubService::find($id);
        return view('admin/services/addoptions', compact('subservice'));
    }

    public function add(Request $request, $id)
{
    $subservice = SubService::find($id);
    $subserv_id = $subservice->subserv_id;

    $options = new Options();
    $options->unq_id = $subserv_id;
    $options->name = $request->name;
    $options->price = $request->price;
    $options->quantified = $request->quantified;
    $options->save();

    $service_id = $subservice->service_id;

    return redirect()->route('admin.viewsubservice', ['id' => $id])->with('status', 'Subservices added successfully.');
}

public function destroyoption(Request $request, $id)
{
   // find the subservice
   $option = Options::find($id);

   // delete the subservice
   $option->delete();

   // redirect back to the view service page
   return redirect()->back()->with('success', 'User has been deleted!');
}




public function viewoptions($id)
{
    $subservice = SubService::find($id);
  $options = Options::where('unq_id', $subservice->subserv_id)->options;

  return view('admin.viewoptions', compact('subservice'. 'options'));
}

}