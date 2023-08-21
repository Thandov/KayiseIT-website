<?php

namespace App\Http\Controllers;

use App\Models\Occupations;
use App\Models\Specializations;
use App\Models\CareerSteps;
use Illuminate\Http\Request;

class OccupationsController extends Controller
{

    public function occupations()
    {
        //
        $occupations = Occupations::all();
        return view('/admin/dashboard/careermapping_dashboard', compact('occupations'));
    }

    public function addoccupations()
    {
        return view('admin/addoccupations');
    }

    public function addoccupation(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'occupation_name' => 'required|string|max:255',
        ]);

        $newImageName = $request->occupation_name . '.' . $request->image->extension();

        $request->image->move(public_path('images/occupations_logo'), $newImageName);

        // Code to safe to database
        $occupation = new Occupations();
        $occupation->image = $newImageName;
        $occupation->occupation_name = $request->occupation_name;
        $occupation->u_id = auth()->user()->id;
        //Save to database
        $occupation->save();
        return redirect()->route('admin.dashboard.careermapping_dashboard')->with('success', 'Occupation added successfully');
    }

    public function showoccupations()
    {
        //
        $occupations = Occupations::all();
        return view('career-mapping', compact('occupations'));
    }

    public function showviewoccupations(Request $request, $occup_id)
    {
        $occupations = Occupations::findOrFail($occup_id);
        $specializations = Specializations::where('occup_id', $occupations->occup_id)->get();

        // Initialize an array to hold career steps for each specialization
        $careerStepsArray = [];

        foreach ($specializations as $specialization) {
            // Retrieve career steps for the current specialization
            $careerSteps = CareerSteps::where('spec_id', $specialization->spec_id)->get();

            // Add career steps to the array
            $careerStepsArray[$specialization->spec_id] = $careerSteps;
        }

        $storedOptions = unserialize($request->session()->get('key'));

        return view('viewoccupations', compact('occupations', 'specializations', 'careerStepsArray'));
    }


    public function showadmin_viewoccupations(Request $request, $occup_id)
    {
        $occupations = Occupations::findOrFail($occup_id);
        $specializations = Specializations::where('occup_id', $occupations->occup_id)->get();
        $storedOptions = unserialize($request->session()->get('key'));

        return view('admin.admin_viewoccupations', compact('occupations', 'specializations'));
    }

    public function updateOccupation(Request $request, $occup_id)
    {
        $request->validate([
            'occupation_name' => 'required|string|max:255',
            'specializations' => 'required|array',
            'specializations.*.specialization_name' => 'required|string|max:255',
            'occup_id' => 'required|exists:occupations,id',
        ]);

        $occupation = Occupations::findOrFail($occup_id);
        $occupation->occupation_name = $request->input('occupation_name');
        $occupation->save();

        $specializations = $request->input('specializations');
        foreach ($specializations as $spec_id => $SpecializationData) {
            $specialization = Specializations::findOrFail($spec_id);
            $specialization->specialization_name = $SpecializationData['specialization_name'];
            $specialization->save();
        }
        return redirect()->back()->with('success', 'Occupation updated successfully.');
    }

    public function delete($occup_id)
    {
        $occupation = Occupations::find($occup_id);

        //Checks if Occupations Exists
        if (!$occupation) {
            return redirect()->back()->withErrors('Occupation not found.');
        }

        $occupation->delete();
        return redirect()->back()->with('success', 'Occupation deleted successfully.');
    }
}
