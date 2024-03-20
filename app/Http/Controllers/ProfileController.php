<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\QuotationService;
use App\Services\InvoiceService;
use App\Models\InternshipApplication;



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
        $applications = InternshipApplication::select('*')->where('user_id', $userid)->get();
        $invoices = $invoiceService->getUserInvoices($userid);
        $quotations = $quotationService->getUserQuotations($userid);
        $quotations = $quotationService->getUserQuotations($userid);

        return view('profile.edit', compact('invoices', 'quotations', 'user', 'applications'));
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
