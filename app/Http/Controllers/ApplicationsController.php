<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\Quotation;
use App\Models\Items;
use App\Models\InternshipApplication;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationNotification;

class ApplicationsController extends Controller
{
    public function store(Request $request)
    {
        // Validate form inputs
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'id_copy' => 'required|file|mimes:pdf|max:2048',
            'qualification_copy' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handle file uploads
        $cvPath = $request->file('cv')->store('cv');
        $idCopyPath = $request->file('id_copy')->store('id_copy');
        $qualificationCopyPath = $request->file('qualification_copy')->store('qualification_copy');

        // Create internship application
        $internship = new InternshipApplication();
        $internship->name = $request->name;
        $internship->email = $request->email;
        $internship->address = $request->address;
        $internship->phone_no = $request->phone;
        $internship->id_no = $request->id_number;
        $internship->age = $request->age;
        $internship->qualification = $request->qualification;
        $internship->year_obtained = $request->year_obtained;
        $internship->institution = $request->institution;
        $internship->cv_path = $cvPath;
        $internship->id_copy_path = $idCopyPath;
        $internship->qualification_copy_path = $qualificationCopyPath;
        $internship->save();


        // Redirect user after successful submission
        return redirect()->back()->with('success', 'Application submitted successfully!');
    }


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
        $application->paid = '0';
        $application->payment_date = 'null';

        $application->save();

        $total = 0;

        $quotation_no = 'Q' . mt_rand(100000, 999999);
        $quotation = new Quotation;
        $quotation->user_id = auth()->user()->id;
        $quotation->quotation_no = $quotation_no;
        $quotation->save();


        $item = new Items;
        $item->user_id = auth()->user()->id;
        $item->unq_id = mt_rand(100, 9999);
        $item->item = 'Drone Workshop 1';
        $item->qty = '1';
        $item->sub_total = 520;
        $item->QI_id = $quotation_no;
        $item->save();
        $total = $total + $item->sub_total;

        $vat = $total * 15 / 100;
        $total_vat = $total + $vat;
        $rounded_total_vat = round($total_vat / 100) * 100;

        //update the quotaion total value
        $quote = Quotation::where('quotation_no', $quotation_no)->first();
        $quote->total_price = $total;
        $quote->job_type = '4IR Training';
        $quote->vat = $vat;
        $quote->total_vat = $rounded_total_vat;
        $quote->save();


        $quotationData = [
            'quotation_no' => $quotation_no,
            'course' => $request->course,
            'total' => $total,
            'vat' => $vat,
            'total_vat' => $rounded_total_vat,
        ];

        $adminEmail = 'info@kayiseit.com';
        Mail::to($adminEmail)->send(new ApplicationNotification($request, $quotationData));

        return view('drone_application/summary', compact('quotationData'));
    }

    public function banking_details()
    {
        return view('drone_application/summary');
    }
}
