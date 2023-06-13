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
    public function create()
    {
        //
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
    public function update(Request $request, CareerSteps $careerSteps)
    {
        //
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
        $careerSteps = CareerSteps::find($steps_id);
        $careerSteps->delete();
    }
}
