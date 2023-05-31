<?php

namespace App\Http\Controllers;

use App\Models\CareerMapping;
use Illuminate\Http\Request;

class CareerMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function careermapping()
    {
        //check Code on front end
        $careermapping = CareerMapping::all();
        return view('career-mapping', compact('career-mapping'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcareermapping()
    {
        //
        return view('admin/addcareermapping');
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
     * @param  \App\Models\CareerMapping  $careerMapping
     * @return \Illuminate\Http\Response
     */
    public function show(CareerMapping $careerMapping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CareerMapping  $careerMapping
     * @return \Illuminate\Http\Response
     */
    public function edit(CareerMapping $careerMapping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareerMapping  $careerMapping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CareerMapping $careerMapping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareerMapping  $careerMapping
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareerMapping $careerMapping)
    {
        //
    }
}