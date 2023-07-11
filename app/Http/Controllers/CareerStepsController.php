<?php

namespace App\Http\Controllers;

use App\Models\CareerSteps;
use App\Models\Specializations;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function addcareersteps(Request $request)
    {
        // Retrieve the input data from the request
        $stepNumbers = $request->input('step_number');
        $qualifications = $request->input('qualification');
        $specId = $request->input('spec_id'); // Assuming you have a field named 'spec_id' in the form
        $occupId = $request->input('occup_id'); // Assuming you have a field named 'occup_id' in the form


        // Loop through the input data and create new career steps
        foreach ($stepNumbers as $key => $stepNumber) {
            $qualification = $qualifications[$key];

            // Create a new CareerStep instance
            $careerStep = new CareerSteps();
            $careerStep->step_number = $stepNumber;
            $careerStep->qualification = $qualification;
            $careerStep->spec_id = $specId;// additions
            $careerStep->occup_id = $occupId;// additions

            // Save the career step to the database
            $careerStep->save();
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Career steps added successfully.');
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
    public function updateCareerStep(Request $request)
    {
        //
        $careerStep = CareerSteps::findOrFail($request->input('steps_id'));
        $careerStep->step_number = $request->input('step_number');
        $careerStep->qualification = $request->input('qualification');
        $careerStep->save();

        return redirect()->back()->with('success', 'Career Step updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareerSteps  $careerSteps
     * @return \Illuminate\Http\Response
     */
    public function delete(CareerSteps $careerstep)
    {
        // checks if exists
        if (!$careerstep) {
            return redirect()->back()->withErrors('Career Step not found.');
        }

        $careerstep->delete();
        return redirect()->back();
    }
}
