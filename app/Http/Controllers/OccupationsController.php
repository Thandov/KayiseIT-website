<?php

namespace App\Http\Controllers;

use App\Models\Occupations;
use App\Models\Specializations;
use Illuminate\Http\Request;

class OccupationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function occupations()
    {
        //
        $occupations = Occupations::all();
        return view('/admin/dashboard/careermapping_dashboard', compact('occupations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addoccupations()
    {
        return view('admin/addoccupations');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addoccupation(Request $request)
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupations  $occupations
     * @return \Illuminate\Http\Response
     */
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
        $storedOptions = unserialize($request->session()->get('key'));

        return view('viewoccupations', compact('occupations', 'specializations'));
    }

    public function showadmin_viewoccupations(Request $request, $occup_id)
    {
        $occupations = Occupations::findOrFail($occup_id);
        $specializations = Specializations::where('occup_id', $occupations->occup_id)->get();
        $storedOptions = unserialize($request->session()->get('key'));

        return view('admin.admin_viewoccupations', compact('occupations', 'specializations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupations  $occupations
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupations $occupations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occupations  $occupations
     * @return \Illuminate\Http\Response
     */
    public function updateOccupation(Request $request, $occup_id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupations  $occupations
     * @return \Illuminate\Http\Response
     */
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
