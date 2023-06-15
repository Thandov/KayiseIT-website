<?php

namespace App\Http\Controllers;

use App\Models\CareerSteps;
use Illuminate\Http\Request;

class CareerStepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function careersteps()
    {
        //
        $careerSteps = CareerSteps::all();
        return view('careersteps_dashboard', compact('careersteps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcareersteps()
    {
        return view('admin/addcareersteps');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Code to safe to database
        $careerStep = new CareerSteps();
        $careerStep->steps_id = $request->steps_id;
        $careerStep->step_number = $request->step_number;
        $careerStep->qualification = $request->qualification;
        $careerStep->save();
        return redirect()->route('admin.dashboard.careersteps_dashboard')->with('success', 'Career step added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CareerSteps  $careerSteps
     * @return \Illuminate\Http\Response
     */
    public function show(CareerSteps $careerSteps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CareerSteps  $careerSteps
     * @return \Illuminate\Http\Response
     */
    public function edit(CareerSteps $careerSteps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareerSteps  $careerSteps
     * @return \Illuminate\Http\Response
     */
    public function updateCareerStep(Request $request, $steps_id)
    {
        //
        $careerStep = CareerSteps::findOrFail($steps_id);
        $careerStep->step_number = $request->input('step_number');
        $careerStep->qualification = $request->input('qualification');
        $careerStep->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareerSteps  $careerSteps
     * @return \Illuminate\Http\Response
     */
    public function delete(CareerSteps $steps_id)
    {
        //
        $careerStep = CareerSteps::find($steps_id);
        $careerStep->delete();
        return redirect()->back();
    }
}
