<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCertificateJob;
use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function __construct(
        protected CertificateEligibilityService $eligibility
    ) {}

    /**
     * Show the certification request form (public).
     */
    public function showForm(): View
    {
        return view('certification.form');
    }

    /**
     * Validate, check eligibility, generate certificate (sync or queue), redirect to download or error.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $idNumber = $validated['id_number'];
        $normalizedId = CertificateEligibilityService::normalizeId($idNumber);
        if ($normalizedId === '') {
            return back()->withInput()->withErrors(['id_number' => 'Please enter a valid ID number.']);
        }

        $learner = $this->eligibility->findLearnerById($idNumber);
        if ($learner === null) {
            return back()->withInput()->withErrors([
                'id_number' => 'This ID number was not found in our records. If you believe this is an error, please contact support.',
            ]);
        }

        $learnerData = [
            'name' => $learner['name'],
            'surname' => $learner['surname'],
            'id_number' => $idNumber,
            'certificate_number' => $learner['certificate_number'],
            'email' => $validated['email'] ?? null,
        ];

        $token = Str::random(48);
        // Run synchronously so we can redirect to download; for async, use dispatch() and notify by email.
        GenerateCertificateJob::dispatchSync($learnerData, $token);

        $record = CertificateDownload::where('download_token', $token)->first();
        if ($record === null) {
            return redirect()
                ->route('certification.form')
                ->withInput()
                ->with('error', 'Certificate generation failed. Please try again or contact support.');
        }

        return redirect()->route('certification.success', ['token' => $token]);
    }

    /**
     * Show congratulations page after successful certificate generation (confetti, download button).
     */
    public function success(Request $request): View|\Illuminate\Http\RedirectResponse
    {
        $token = $request->query('token');
        if (! $token) {
            return redirect()->route('certification.form')->with('error', 'Invalid link.');
        }
        $record = CertificateDownload::where('download_token', $token)->first();
        if ($record === null || $record->isExpired()) {
            return redirect()->route('certification.form')->with('error', 'Invalid or expired link.');
        }
        return view('certification.success', [
            'token' => $token,
            'name' => trim($record->name . ' ' . $record->surname),
            'training_name' => config('certificates.training_name', 'Business Essentials for Entrepreneurs'),
        ]);
    }

    /**
     * Download certificate by token (only the generated file is accessible; token is one-time use in practice).
     */
    public function download(Request $request)
    {
        $token = $request->query('token');
        if (! $token) {
            return redirect()->route('certification.form')->with('error', 'Invalid download link.');
        }
        $record = CertificateDownload::where('download_token', $token)->first();
        if ($record === null) {
            return redirect()->route('certification.form')->with('error', 'Invalid or expired download link.');
        }
        if ($record->isExpired()) {
            return redirect()->route('certification.form')->with('error', 'This download link has expired.');
        }

        $disk = config('certificates.storage_disk', 'local');
        $fullPath = \Illuminate\Support\Facades\Storage::disk($disk)->path($record->storage_path);
        if (! is_file($fullPath) || ! is_readable($fullPath)) {
            return redirect()->route('certification.form')->with('error', 'Certificate file is no longer available. Please contact support.');
        }

        $filename = 'Certificate_' . trim($record->name . ' ' . $record->surname) . '.pdf';
        $filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename) ?: 'certificate.pdf';

        return response()->download($fullPath, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
