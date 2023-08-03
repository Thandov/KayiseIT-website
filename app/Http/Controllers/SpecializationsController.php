<?php

namespace App\Http\Controllers;

use App\Models\Specializations;
use App\Models\CareerSteps;
use App\Models\Occupations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SpecializationsController extends Controller
{
    public function specializations()
    {
        $specializations = Specializations::all();
        return view('careermapping_dashboard', compact('occupations'));
    }

    public function showviewspecialization(Request $request, $spec_id)
    {
        $specializations = Specializations::findOrFail($spec_id);
        $careerSteps = CareerSteps::where('spec_id', $specializations->spec_id)->get();
        $storedOptions = unserialize($request->session()->get('key'));

        return view('viewspecialization', compact('specializations', 'careerSteps'));
    }

    public function showadmin_viewspecialization(Request $request, $spec_id)
    {
        //show career steps on view specializations blade
        $specializations = Specializations::findOrFail($spec_id);
        $careerSteps = CareerSteps::where('spec_id', $specializations->spec_id)->orderBy('step_number', 'asc')->get();
        $storedOptions = unserialize($request->session()->get('key'));
        $results = DB::table('career_steps')->where('spec_id', $spec_id)->get(); //limit the selection
        $arrlength = count($results);   // to get the length of the array
        $arrlength = ++$arrlength;

        $occup_id = $specializations->occup_id;

        return view('/admin/career_mapping/viewspecialization', compact('specializations', 'careerSteps', 'arrlength', 'occup_id'));
    }

    public function addspecialization(Request $request, $occup_id)
    {
        $request->validate([
            'spec_name' => 'required|array',
            'spec_name.*' => 'required|string|max:255',
            'occup_id' => 'required|exists:specializations,occup_id',
        ]);

        // Get the array of specialization names from the request
        $specializations = $request->input('spec_name');

        foreach ($specializations as $specializationName) {
            // Create a new specialization instance
            $specialization = new Specializations();
            $specialization->occup_id = $occup_id;
            $specialization->specialization_name = $specializationName;
            $specialization->save();
        }
        return redirect()->back()->with('success', 'Specializations added successfully.');
    }

    public function viewspecialization($spec_id)
    {
        $specializations = Specializations::find($spec_id);
        return view('admin/career_mapping/viewspecialization', compact('specializations'));
    }

    public function updateSpecialization(Request $request)
    {
        //Input Validations
        $request->validate([
            'spec_id' => 'required|exists:specializations,id',
            'specialization_name' => 'required|string|max:255', 
        ]);

        $specialization = Specializations::findOrFail($request->input('spec_id'));
        $specialization->specialization_name = $request->input('specialization_name');
        $specialization->save();
        return back()->with('success', 'Specialization updated Successfully.');
    }

    public function delete(Specializations $specialization)
    {
        // checks if exists
        if (!$specialization) {
            return redirect()->back()->withErrors('Specialization not found.');
        }

        $specialization->delete();
        return redirect()->back()->with('success', 'Specialization deleted Successfully.');
    }
}
