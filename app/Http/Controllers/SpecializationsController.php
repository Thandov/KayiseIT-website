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

        return view('viewoccupations', compact('specializations', 'careerSteps'));
    }

    public function addspecializations()
    {
        return view('admin/addspecializations');
    }
    public function addspecialization(Request $request, $occup_id)
    {
        //
        $occupation = Occupations::find($occup_id);
        $occup_id = $occupation->occup_id;

        // Code to save to database
        $specialization = new Specializations();
        $specialization->occup_id = $occup_id;
        $specialization->u_id = auth()->user()->id;
        $specialization->specialization_name = $request->specialization;
        $specialization->save();
        return redirect()->route('admin.admin_viewoccupations', ['occup_id' => $occup_id])->with('success', 'Specialization added successfully');
    }

    public function viewspecialization($spec_id)
    {
        $specializations = Specializations::find($spec_id);
        return view('admin/career_mapping/viewspecialization', compact('specializations'));
    }

    public function updateSpecialization(Request $request, $spec_id)
    {
        //
        dd($request->input());
        $specialization = Specializations::findOrFail($spec_id);
        $specialization->specialization_name = $request->input('specialization_name');
        $specialization->save();

        $career_steps = $request->input('career_steps');
        foreach ($career_steps as $steps_id => $career_stepData) {
            $career_step = CareerSteps::findOrFail($steps_id);
            $career_step->step_number = $career_stepData['step_number'];
            $career_step->qualification = $career_stepData['qualification'];
            $career_step->save();
        }
        return redirect()->back()->with('success', 'Specialization updated successfully.');
    }

    public function delete(Specializations $spec_id)
    {
        $specialization = Specializations::find($spec_id);
        $specialization->delete();
        return redirect()->back();
    }
}
