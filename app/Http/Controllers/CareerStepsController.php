<?php

namespace App\Http\Controllers;

use App\Models\CareerSteps;
use App\Models\Specializations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $stepNumbers = $request->input('step_number');  //from form
        $qualifications = $request->input('qualification'); //from form
        $specId = $request->input('spec_id'); //from form hidden
        $occupId = $request->input('occup_id'); //from form hidden
        $results = DB::table('career_steps')->where('spec_id', $specId)->orderBy('step_number')->get(); //limit the selection and order in assending order
        $arrlength = count($results);   // to get the length of the array
        $number = 1; //initialzie the number 

        //code to correct the sequence of numbers in the Array
        for ($x = 0; $x < $arrlength; $x++) {
            $results[$x]->step_number = $number;
            $number++;
        }
        // Update the step_number column in the career_steps table
        foreach ($results as $result) {
            DB::table('career_steps')->where('steps_id', $result->steps_id)->update(['step_number' => $result->step_number]);
        } 
        
        foreach ($stepNumbers as $key => $stepNumber) {
            // Create a new CareerStep instance
            $careerStep = new CareerSteps();
            $careerStep->step_number = $stepNumber;
            $careerStep->qualification = $qualifications[$key];
            $careerStep->u_id = null; // Replace this with the actual user ID if you have it
            $careerStep->occup_id = $occupId;
            $careerStep->spec_id = $specId;
            $careerStep->save();
    
            // Increment the number for the next step (if needed)
            $number++;
        }
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Career steps added successfully.');
    }

    public function updatePosition(Request $request)
    {
        $steps_id = $request->input('steps_id');
        $newPosition = $request->input('newPosition');

        // Update the position in the database based on the $stepId and $newPosition

        // Return a response (e.g., JSON response)
        return response()->json(['success' => true]);
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

        $occupId = $careerstep->occup_id;
        $specId = $careerstep->spec_id;
        $careerstep->delete(); // Delete the career step from the database

        // Limit the selection
        $results = DB::table('career_steps')->where('occup_id', $occupId)->where('spec_id', $specId)->orderBy('step_number')->get(); // Orderby step number might be needed
        $arrlength = count($results);   // to get the length of the array
        $number = 1; //initialzie the number

        //code to correct the sequence of numbers in the Array
        for ($x = 0; $x < $arrlength; $x++) {
            $results[$x]->step_number = $number;
            $number++;
        }

        foreach ($results as $result) {
            DB::table('career_steps')->where('steps_id', $result->steps_id)->update(['step_number' => $result->step_number]);
        }

        return redirect()->back();
    }
}
////////////////Kray_ATM