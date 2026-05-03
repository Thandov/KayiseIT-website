<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PrepareCertificationAjaxJson;
use App\Jobs\GenerateCertificateJob;
use App\Mail\CertificateDeliveredMail;
use App\Mail\CertificateSupportRequestMail;
use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $expectsJson = $request->expectsJson()
            || (string) $request->input(PrepareCertificationAjaxJson::JSON_RESPONSE_BODY_FLAG, '') === '1';

        $id = trim($validated['id_number']);

        $learner = $this->eligibility->findLearnerById($id);

        if ($learner === null) {
            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'id_number' => [
                            'This ID number was not found in our records. If you believe this is an error, please contact support.',
                        ],
                    ],
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors([
                    'id_number' => 'This ID number was not found in our records. If you believe this is an error, please contact support.',
                ]);
        }

        $name = trim($learner['name']) ?: trim($validated['name'] ?? '');
        $surname = trim($learner['surname']) ?: trim($validated['surname'] ?? '');
        if ($name === '' && $surname === '') {
            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'id_number' => [
                            'Your learner record has no name on file. Please add your name and surname below, then use Email support.',
                        ],
                    ],
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors([
                    'id_number' => 'Your learner record has no name on file. Please contact support.',
                ]);
        }

        $cert = trim($learner['certificate_number'] ?? '');

        if (! GenerateCertificateJob::canEmitCertificatePdf()) {
            $diskMessage = 'The server cannot write certificate files right now, usually because the hosting account has reached its disk space limit. Please free space (for example archive or delete old email) or ask your host to raise the quota, then try again. You can still use Email support below.';

            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'certificate_failed' => true,
                    'message' => $diskMessage,
                ]);
            }

            return back()->withInput()->withErrors(['certificate' => $diskMessage]);
        }

        try {
            $token = GenerateCertificateJob::dispatchSync([
                'name' => $name,
                'surname' => $surname,
                'id_number' => $id,
                'certificate_number' => $cert,
                'email' => $validated['email'] ?? null,
            ]);
        } catch (\Throwable $e) {
            try {
                \Log::error('Certificate generation threw', [
                    'id_number' => $id,
                    'exception' => $e->getMessage(),
                ]);
            } catch (\Throwable $ignored) {
            }
            $token = null;
        }

        if ($token === null) {
            try {
                \Log::error('Certificate generation failed (GenerateCertificateJob returned null)', [
                    'id_number' => $id,
                ]);
            } catch (\Throwable $e) {
                // Avoid masking the user-facing error if logging fails (e.g. full disk).
            }
            $userMessage = 'We could not create your certificate automatically. Please fill in your name, surname, and email below so our team can assist you, then tap Email support.';

            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'certificate_failed' => true,
                    'message' => $userMessage,
                ]);
            }

            return back()->withInput()->withErrors(['certificate' => $userMessage]);
        }

        $successUrl = route('certification.success', [
            'token' => $token,
        ]);

        $learnerEmail = trim((string) ($validated['email'] ?? ''));
        if ($learnerEmail !== '' && filter_var($learnerEmail, FILTER_VALIDATE_EMAIL)) {
            $downloadRecord = CertificateDownload::where('download_token', $token)->first();
            if ($downloadRecord !== null) {
                try {
                    Mail::to($learnerEmail)->send(new CertificateDeliveredMail(
                        $downloadRecord,
                        (string) config('certificates.training_name', 'Business Essentials for Entrepreneurs')
                    ));
                } catch (\Throwable $e) {
                    \Log::error('Certificate delivered email failed', [
                        'token_prefix' => substr((string) $token, 0, 8),
                        'exception' => $e->getMessage(),
                    ]);
                }
            }
        }

        if ($expectsJson) {
            return response()->json([
                'success' => true,
                'redirect' => $successUrl,
            ]);
        }

        return redirect()->to($successUrl);
    }

    /**
     * After certificate PDF generation failed, learner emails support with contact details (AJAX).
     */
    public function sendSupportInquiry(Request $request)
    {
        $validated = $request->validate([
            'id_number' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $expectsJson = $request->expectsJson()
            || (string) $request->input(PrepareCertificationAjaxJson::JSON_RESPONSE_BODY_FLAG, '') === '1';

        try {
            Mail::to('info@kayiseit.com')->send(new CertificateSupportRequestMail($validated));
        } catch (\Throwable $e) {
            \Log::error('Certificate support mail failed', ['exception' => $e->getMessage()]);

            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'We could not send your message right now. Please email info@kayiseit.com directly.',
                ], 500);
            }

            return back()->withInput()->with('error', 'Could not send your message. Please email info@kayiseit.com.');
        }

        if ($expectsJson) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you. Our team has received your details and will get back to you soon.',
            ]);
        }

        return redirect()->route('certification.form')->with('success', 'Your message was sent.');
    }

    /**
     * Show congratulations page after successful certificate generation (confetti, download button).
     */
    public function success(Request $request): View|\Illuminate\Http\RedirectResponse
    {
        $token = trim((string) $request->query('token', ''));
        if ($token === '') {
            return redirect()->route('certification.form')->with('error', 'Invalid link.');
        }

        $download = CertificateDownload::where('download_token', $token)->first();
        if ($download === null || $download->isExpired()) {
            return redirect()->route('certification.form')->with('error', 'This link has expired or is invalid.');
        }

        $display = trim(trim((string) $download->name) . ' ' . trim((string) $download->surname));

        return view('certification.success', [
            'name' => $display !== '' ? $display : 'Recipient',
            'training_name' => config('certificates.training_name', 'Business Essentials for Entrepreneurs'),
            'download_token' => $token,
        ]);
    }

    /**
     * Download certificate by token (only the generated file is accessible; token is one-time use in practice).
     */
    public function download(Request $request)
    {
        GenerateCertificateJob::configureCertificateDiskRoot();

        $token = trim((string) $request->query('token', ''));
        if ($token === '') {
            return redirect()->route('certification.form')->with('error', 'Invalid download link.');
        }

        $download = CertificateDownload::where('download_token', $token)->first();
        if ($download === null || $download->isExpired()) {
            return redirect()->route('certification.form')->with('error', 'This download link has expired or is invalid.');
        }

        $disk = config('certificates.storage_disk', 'certificates_local');
        $relative = $download->storage_path;
        if ($relative === '' || ! Storage::disk($disk)->exists($relative)) {
            \Log::error('Certificate file missing for token', ['token_prefix' => substr($token, 0, 8)]);

            return redirect()->route('certification.form')->with('error', 'Certificate not found.');
        }

        $absolute = Storage::disk($disk)->path($relative);
        $filename = basename($relative);

        return response()->download($absolute, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
