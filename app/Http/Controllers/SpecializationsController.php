<?php

namespace App\Http\Controllers;

use App\Models\Specializations;
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
    public function update(Request $request, Specializations $specializations)
    {
        //
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
        $specializations = Specializations::find($spec_id);
        $specializations->delete();
    }
}
