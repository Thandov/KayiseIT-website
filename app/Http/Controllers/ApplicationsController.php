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
use Illuminate\Validation\ValidationException;
use App\Mail\ApplicationNotification;
use App\Mail\ApplicationSummary;
use App\Mail\InternshipConfirmation;
use App\Mail\NewIntenshipNotification;
use App\Helpers\UserFolderHelper;
use App\Models\InternshipProgram;
use App\Models\Person;
use App\Models\UserProject;
use App\Services\ProgramApplicationService;

class ApplicationsController extends Controller
{
    public function store(Request $request, ProgramApplicationService $applicationService)
    {
        $user = Auth::user();

        if ($request->filled('selected_program_id') && ! $request->filled('internship_program_id')) {
            $request->merge(['internship_program_id' => $request->input('selected_program_id')]);
        }

        $programId = $request->input('internship_program_id') ?? $request->input('selected_program_id');
        if (! $programId) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please select a programme to apply for.'], 422);
            }

            return redirect()->route('opportunities')->with('error', 'Please select a programme to apply for.');
        }

        $selectedProgram = InternshipProgram::active()->find($programId);
        if (! $selectedProgram) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'This programme is no longer available for applications.'], 422);
            }

            return redirect()->route('opportunities')->with('error', 'This program is no longer available for applications.');
        }

        try {
            $applicationService->assertNoDuplicateApplication($user, $selectedProgram);
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'errors' => $e->errors()], 422);
            }

            return redirect('/profile')->with('error', 'You have already applied for this programme. Find your application details on your profile.');
        }

        $validated = $applicationService->validateSubmission($request, $selectedProgram, $user);

        if ($request->filled('phone')) {
            User::where('id', $user->id)->update(['phone' => $request->phone]);
        }

        $internship = $applicationService->createSubmission(
            $validated,
            $selectedProgram,
            Person::TYPE_APPLICATION,
            $user,
            'application'
        );

        $idCopyPath = $internship->id_copy_path;
        $proofOfPaymentPath = $internship->proof_of_payment_path;

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
            Mail::to($adminEmails)->send(new NewIntenshipNotification($internship, $user->name, $idCopyPath, $proofOfPaymentPath));
        } catch (\Throwable $e) {
            $mailFailed = true;
            Log::warning('Failed to send internship admin notification email.', [
                'user_id' => $user->id,
                'application_id' => $internship->id,
                'error' => $e->getMessage(),
            ]);
        }

        $successMessage = $mailFailed
            ? 'Application submitted successfully. Email notification is temporarily unavailable.'
            : 'Application submitted successfully!';

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $successMessage]);
        }

        return redirect('/profile')->with('success', $successMessage);
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

    public function editUserApplication($id)
    {
        $user = Auth::user();
        $application = InternshipApplication::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('profile.partials.edit_application', compact('application'));
    }

    public function updateUserApplication(Request $request, $id)
    {
        $user = Auth::user();
        $application = InternshipApplication::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $request->validate([
            'age'                    => 'required|integer|min:1|max:120',
            'address'                => 'nullable|string|max:500',
            'app_type'               => 'required|string|max:100',
            'field'                  => 'required|string|max:100',
            'high_school'            => 'nullable|string|max:255',
            'year_of_completion'     => 'nullable|string|max:4',
            'qualification'          => 'nullable|string|max:255',
            'year_obtained'          => 'nullable|string|max:4',
            'institution'            => 'nullable|string|max:255',
            'cv'                     => 'nullable|file|mimes:pdf|max:2048',
            'id_copy'                => 'nullable|file|mimes:pdf|max:2048',
            'qualification_copy'     => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $folderName      = UserFolderHelper::generateFolderName($user);
        $opportunityType = 'internship';

        if ($request->hasFile('cv')) {
            $cvFileName      = 'cv_' . $folderName . '.' . $request->file('cv')->getClientOriginalExtension();
            $application->cv_path = UserFolderHelper::storeUserFile($user, $request->file('cv'), $cvFileName, $opportunityType);
        }

        if ($request->hasFile('id_copy')) {
            $idCopyFileName        = 'id_copy_' . $folderName . '.' . $request->file('id_copy')->getClientOriginalExtension();
            $application->id_copy_path = UserFolderHelper::storeUserFile($user, $request->file('id_copy'), $idCopyFileName, $opportunityType);
        }

        if ($request->hasFile('qualification_copy')) {
            $qualFileName                  = 'qualification_copy_' . $folderName . '.' . $request->file('qualification_copy')->getClientOriginalExtension();
            $application->qualification_copy_path = UserFolderHelper::storeUserFile($user, $request->file('qualification_copy'), $qualFileName, $opportunityType);
        }

        $application->age                = $request->age;
        $application->address            = $request->address;
        $application->app_type           = $request->app_type;
        $application->field              = $request->field;
        $application->high_school        = $request->high_school;
        $application->year_of_completion = $request->year_of_completion;
        $application->qualification      = $request->qualification;
        $application->year_obtained      = $request->year_obtained;
        $application->institution        = $request->institution;
        $application->save();

        return redirect()->route('profile.edit')->with('success', 'Application updated successfully.');
    }

    public function destroyUserApplication($id)
    {
        $user = Auth::user();
        $application = InternshipApplication::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $application->delete();

        return redirect()->route('profile.edit')->with('success', 'Application deleted.');
    }

    // ── User Portfolio Projects ──────────────────────────────────────────────

    public function storeProject(Request $request)
    {
        $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string|max:1000',
            'status'                => 'required|in:published,in_progress',
            'live_url'              => 'nullable|url|max:500',
            'github_url'            => 'nullable|url|max:500',
            'gitlab_url'            => 'nullable|url|max:500',
            'bitbucket_url'         => 'nullable|url|max:500',
            'other_platform_label'  => 'nullable|string|max:100',
            'other_platform_url'    => 'nullable|url|max:500',
        ]);

        UserProject::create([
            'user_id'               => Auth::id(),
            'title'                 => $request->title,
            'description'           => $request->description,
            'status'                => $request->status,
            'live_url'              => $request->live_url ?: null,
            'github_url'            => $request->github_url ?: null,
            'gitlab_url'            => $request->gitlab_url ?: null,
            'bitbucket_url'         => $request->bitbucket_url ?: null,
            'other_platform_label'  => $request->other_platform_label ?: null,
            'other_platform_url'    => $request->other_platform_url ?: null,
        ]);

        return redirect()->route('profile.edit', ['#tab-portfolio'])->with('success', 'Project added.');
    }

    public function updateProject(Request $request, $id)
    {
        $project = UserProject::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string|max:1000',
            'status'                => 'required|in:published,in_progress',
            'live_url'              => 'nullable|url|max:500',
            'github_url'            => 'nullable|url|max:500',
            'gitlab_url'            => 'nullable|url|max:500',
            'bitbucket_url'         => 'nullable|url|max:500',
            'other_platform_label'  => 'nullable|string|max:100',
            'other_platform_url'    => 'nullable|url|max:500',
        ]);

        $project->update([
            'title'                 => $request->title,
            'description'           => $request->description,
            'status'                => $request->status,
            'live_url'              => $request->live_url ?: null,
            'github_url'            => $request->github_url ?: null,
            'gitlab_url'            => $request->gitlab_url ?: null,
            'bitbucket_url'         => $request->bitbucket_url ?: null,
            'other_platform_label'  => $request->other_platform_label ?: null,
            'other_platform_url'    => $request->other_platform_url ?: null,
        ]);

        return redirect()->route('profile.edit', ['#tab-portfolio'])->with('success', 'Project updated.');
    }

    public function destroyProject($id)
    {
        UserProject::where('id', $id)->where('user_id', Auth::id())->firstOrFail()->delete();

        return redirect()->route('profile.edit', ['#tab-portfolio'])->with('success', 'Project removed.');
    }
}
