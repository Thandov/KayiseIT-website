<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApplicationsController extends Controller
{
    public function drone_registration(Request $request)
    {
        $application = new Application();
        $application->user_id = Auth::user()->id;
        $application->name = $request->name;
        $application->surname = $request->surname;
        $application->dob = $request->dob;
        $application->gender = $request->gender;
        $application->age = $request->age;

        $application->highest_level = $request->highest_level;
        $application->school_name = $request->school_name;

        $application->number = $request->number;
        $application->address = $request->address;

        $application->guardian_name = $request->guardian_name;
        $application->relation = $request->relation;
        $application->guardian_number = $request->guardian_number;
        $application->guardian_email = $request->guardian_email;
        $application->guardian_address = $request->guardian_address;

        $application->kin_name = $request->kin_name;
        $application->kin_relation = $request->kin_relation;
        $application->kin_number = $request->kin_number;

        $application->course = $request->course;
        $application->paid = $request->paid;
        $application->payment_date = $request->payment_date;

        $application->save();

        dd($application);

        return redirect(RouteServiceProvider::HOME);
    }
}
