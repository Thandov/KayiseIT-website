<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\QuotationService;
use App\Services\InvoiceService;
use App\Models\InternshipApplication;
use App\Models\Application;
use App\Models\UserProject;
use App\Models\InternshipProgram;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(InvoiceService $invoiceService, QuotationService $quotationService)
    {
        $userid = Auth::user()->id;
        $user = Auth::user();
        $applications = InternshipApplication::with('internshipProgram')->where('user_id', $userid)->get();
        $droneapps = Application::select('*')->where('user_id', $userid)->get();
        $invoices = $invoiceService->getUserInvoices($userid);
        $quotations = $quotationService->getUserQuotations($userid);
        $userProjects = UserProject::where('user_id', $userid)->latest()->get();
        $activePrograms = InternshipProgram::active()->orderBy('name')->get();

        $personalInfoComplete = !empty($user->phone)
            && !empty($user->id_number)
            && !empty($user->age)
            && !empty($user->address)
            && !empty($user->province);

        return view('profile.edit', compact('invoices', 'quotations', 'user', 'applications', 'droneapps', 'userProjects', 'activePrograms', 'personalInfoComplete'));
    }

    /**
     * Update the user's personal information (contact, education and documents).
     */
    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'phone'                  => 'nullable|string|max:20',
            'id_number'              => 'nullable|string|max:20',
            'age'                    => 'nullable|integer|min:1|max:120',
            'address'                => 'nullable|string|max:500',
            'province'               => 'nullable|string|max:100',
            'high_school'            => 'nullable|string|max:255',
            'year_of_completion'     => 'nullable|string|max:4',
            'qualification'          => 'nullable|string|max:255',
            'institution'            => 'nullable|string|max:255',
            'year_obtained'          => 'nullable|string|max:4',
            'cv'                     => 'nullable|file|mimes:pdf|max:2048',
            'id_copy'                => 'nullable|file|mimes:pdf|max:2048',
            'qualification_copy'     => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();

        $fields = $request->only(
            'phone', 'id_number', 'age', 'address', 'province',
            'high_school', 'year_of_completion', 'qualification', 'institution', 'year_obtained'
        );

        $folderName      = \App\Helpers\UserFolderHelper::generateFolderName($user);
        $opportunityType = 'general';

        if ($request->hasFile('cv')) {
            $fields['cv_path'] = \App\Helpers\UserFolderHelper::storeUserFile(
                $user, $request->file('cv'),
                'cv_' . $folderName . '.pdf', $opportunityType
            );
        }
        if ($request->hasFile('id_copy')) {
            $fields['id_copy_path'] = \App\Helpers\UserFolderHelper::storeUserFile(
                $user, $request->file('id_copy'),
                'id_copy_' . $folderName . '.pdf', $opportunityType
            );
        }
        if ($request->hasFile('qualification_copy')) {
            $fields['qualification_copy_path'] = \App\Helpers\UserFolderHelper::storeUserFile(
                $user, $request->file('qualification_copy'),
                'qualification_copy_' . $folderName . '.pdf', $opportunityType
            );
        }

        $user->fill($fields)->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Personal information saved.',
                'cv_stored'    => !empty($user->cv_path),
                'id_stored'    => !empty($user->id_copy_path),
                'qual_stored'  => !empty($user->qualification_copy_path),
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'Personal information saved.');
    }

    /**
     * Return the rendered applications list partial for AJAX refresh.
     */
    public function applicationsPartial()
    {
        $userid = Auth::user()->id;
        $applications = InternshipApplication::with('internshipProgram')->where('user_id', $userid)->get();
        $droneapps = Application::select('*')->where('user_id', $userid)->get();
        return view('profile.partials.application', compact('applications', 'droneapps'))->render();
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getQuoation(QuotationService $quotationService, $quote)
    {
        $userid = Auth::user()->id;
        $quotation = $quotationService->viewQuote($quote);
        return view('profile/partials/viewquote', compact('quotation'));

    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
