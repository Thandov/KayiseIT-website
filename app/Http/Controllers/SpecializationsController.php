<?php

namespace App\Http\Controllers;

use App\Models\Specializations;
use App\Models\CareerSteps;
use App\Models\Occupations;
use Illuminate\Http\Request;

class SpecializationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function specializations()
    {
        //
        $specializations = Specializations::all();
        return view('careermapping_dashboard', compact('occupations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addspecializations()
    {
        return view('admin/addspecializations');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $occupation = Occupations::find($id);
        $id = $occupation->id;
        $occup_id = $occupation->occup_id;

        // Code to safe to database
        $specialization = new Specializations();
        $specialization->occup_id = $occup_id;
        $specialization->spec_id = $request->spec_id;
        $specialization->specialization_name = $request->specialization_name;
        $specialization->save();
        return redirect()->route('admin.dashboard.specialization_dashboard')->with('success', 'Specialization added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specializations  $specializations
     * @return \Illuminate\Http\Response
     */
    public function show(Specializations $specializations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specializations  $specializations
     * @return \Illuminate\Http\Response
     */
    public function edit(Specializations $specializations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specializations  $specializations
     * @return \Illuminate\Http\Response
     */
    public function updateSpecialization(Request $request, $spec_id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specializations  $specializations
     * @return \Illuminate\Http\Response
     */
    public function delete(Specializations $spec_id)
    {
        //
        $specialization = Specializations::find($spec_id);
        $specialization->delete();
        return redirect()->back();
    }
}
