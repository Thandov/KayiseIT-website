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
use Illuminate\Support\Facades\Log;
use App\Mail\ApplicationNotification;
use App\Mail\ApplicationSummary;
use App\Mail\InternshipConfirmation;
use App\Mail\NewIntenshipNotification;
use App\Helpers\UserFolderHelper;
use App\Models\InternshipProgram;

class ApplicationsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
            'id_copy' => 'required|file|mimes:pdf|max:2048',
            'qualification_copy' => 'required|file|mimes:pdf|max:2048',
            'selected_program_id' => 'nullable|exists:internship_programs,id',
        ]);

        $user = Auth::user();
        $selectedProgram = null;

        if (!empty($validatedData['selected_program_id'])) {
            $selectedProgram = InternshipProgram::active()->find($validatedData['selected_program_id']);
            if (!$selectedProgram) {
                return redirect()->route('opportunities')->with('error', 'This program is no longer available for applications.');
            }
        }

        $existingApplicationQuery = InternshipApplication::where('user_id', $user->id);

        if ($selectedProgram) {
            $existingApplicationQuery->where('internship_program_id', $selectedProgram->id);
        } else {
            $existingApplicationQuery->whereNull('internship_program_id');
        }

        if ($existingApplicationQuery->exists()) {
            return redirect('/profile')->with('error', 'You have already applied for this programme. Find your application details on your profile.');
        }

        $folderName = UserFolderHelper::generateFolderName($user);

        // Create a directory in the appropriate folder based on application type
        $opportunityType = 'internship'; // Default for internship applications
        $folderPath = UserFolderHelper::createUserFolder($user, $opportunityType);

        // Handle file uploads using the new helper
        $cvFileName = 'cv_' . $folderName . '.' . $request->file('cv')->getClientOriginalExtension();
        $cvPath = UserFolderHelper::storeUserFile($user, $request->file('cv'), $cvFileName, $opportunityType);

        $idCopyFileName = 'id_copy_' . $folderName . '.' . $request->file('id_copy')->getClientOriginalExtension();
        $idCopyPath = UserFolderHelper::storeUserFile($user, $request->file('id_copy'), $idCopyFileName, $opportunityType);

        $qualificationCopyFileName = 'qualification_copy_' . $folderName . '.' . $request->file('qualification_copy')->getClientOriginalExtension();
        $qualificationCopyPath = UserFolderHelper::storeUserFile($user, $request->file('qualification_copy'), $qualificationCopyFileName, $opportunityType);
        
        /* Update the user phone number in user table */
        User::where('id', $user->id)->update(['phone' => $request->phone]);

        // Create internship application
        $internship = new InternshipApplication();
        $internship->app_id = $folderName;
        $internship->user_id = $user->id;
        $internship->name = $user->name;
        $internship->email = $user->email;
        $internship->id_no = $request->id_number;
        $internship->age = $request->age;
        
        $internship->app_type = $request->app_type;
        $internship->field = $request->field;
        $internship->internship_program_id = $selectedProgram?->id;
        $internship->program_partner = $selectedProgram?->partner?->name;
        $internship->status = 'pending';

        /* High School */
        $internship->address = $request->address;
        $internship->high_school = $request->high_school;
        $internship->year_of_completion = $request->year_of_completion;

        /* Tertiary */
        $internship->qualification = $request->qualification;
        $internship->year_obtained = $request->year_obtained;
        $internship->institution = $request->institution;

        /* Doc Verification */
        $internship->cv_path = $cvPath;
        $internship->id_copy_path = $idCopyPath;
        $internship->qualification_copy_path = $qualificationCopyPath;
        
        $internship->save();

        $mailFailed = false;

        try {
            Mail::to($user->email)->send(new InternshipConfirmation());
        } catch (\Throwable $e) {
            $mailFailed = true;
            Log::warning('Failed to send internship confirmation email.', [
                'user_id' => $user->id,
                'application_id' => $internship->id,
                'error' => $e->getMessage(),
            ]);
        }

        $adminEmails = ['info@kayiseit.com', 'thapelo@kayiseit.com', 'thando@kayiseit.com'];
        try {
            Mail::to($adminEmails)->send(new NewIntenshipNotification($internship, $user->name, $cvPath, $idCopyPath, $qualificationCopyPath));
        } catch (\Throwable $e) {
            $mailFailed = true;
            Log::warning('Failed to send internship admin notification email.', [
                'user_id' => $user->id,
                'application_id' => $internship->id,
                'error' => $e->getMessage(),
            ]);
        }

        if ($mailFailed) {
            return redirect('/profile')->with('success', 'Application submitted successfully. Email notification is temporarily unavailable.');
        }

        return redirect('/profile')->with('success', 'Application submitted successfully!');
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
        $application->status = 'pending';

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
        $item->sub_total = 521.74;
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
        try {
            Mail::to($adminEmail)->send(new ApplicationNotification($request, $quotationData));
        } catch (\Throwable $e) {
            Log::warning('Failed to send drone application admin email.', [
                'user_id' => auth()->id(),
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);
        }

        $userEmail = auth()->user()->email;
        try {
            Mail::to($userEmail)->send(new ApplicationSummary($quotationData));
        } catch (\Throwable $e) {
            Log::warning('Failed to send drone application summary email.', [
                'user_id' => auth()->id(),
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);
        }

        return view('drone_application/summary', compact('quotationData'));
    }

    public function banking_details()
    {
        return view('drone_application/summary');
    }
}
