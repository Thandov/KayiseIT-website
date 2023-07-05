<?php

namespace App\Http\Controllers;

use App\Models\Specializations;
use App\Models\CareerSteps;
use App\Models\Occupations;
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
        $specializations = Specializations::findOrFail($spec_id);
        $careerSteps = CareerSteps::where('spec_id', $specializations->spec_id)->get();
        $storedOptions = unserialize($request->session()->get('key'));

        return view('/admin/career_mapping/viewspecialization', compact('specializations', 'careerSteps'));
    }

    public function addspecializations()
    {
        return view('admin/addspecializations');
    }
    public function addspecialization(Request $request, $occup_id)
    {
        // Get the array of specialization names from the request
        $specializationData = $request->input('spec_name');

        // Loop through the array and save each specialization
        foreach ($specializationData as $specializationName) {
            $specialization = new Specializations();
            $specialization->occup_id = $occup_id;
            $specialization->specialization_name = $specializationName;
            $specialization->save();
        }

        // Redirect or return a response according to your needs
        return redirect()->back()->with('success', 'Specializations added successfully.');
    }
    

    public function viewspecialization($spec_id)
    {
        $specializations = Specializations::find($spec_id);
        return view('admin/career_mapping/viewspecialization', compact('specializations'));
    }

    public function updateSpecialization(Request $request)
    {
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
        return redirect()->back();
    }
}
