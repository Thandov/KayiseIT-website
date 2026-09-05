<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PrepareCertificationAjaxJson;
use App\Jobs\GenerateCertificateJob;
use App\Mail\CertificateSupportRequestMail;
use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use App\Services\CertificatePdfEmailDelivery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

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
     * JSON lookup for auto-filling name/surname when the learner types 9+ ID digits or pastes a full ID.
     */
    public function lookupLearner(Request $request): JsonResponse
    {
        $raw = (string) $request->query('id', '');
        $digits = preg_replace('/\D+/', '', $raw);
        $len = strlen($digits);
        if ($len < 9 || $len > 13) {
            return response()->json([
                'found' => false,
                'message' => 'Provide at least 9 digits of your ID (up to 13).',
            ], 422);
        }

        $learner = $this->eligibility->findLearnerByPartialId($raw);
        if ($learner === null) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'name' => $learner['name'],
            'surname' => $learner['surname'],
        ]);
    }

    /**
     * Validate, check eligibility, generate certificate (sync or queue), redirect to download or error.
     */
    public function submit(Request $request)
    {
        // #region agent log
        $agentRunId = 'cert_' . bin2hex(random_bytes(8));
        // #endregion

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
            // #region agent log
            $this->agentDebugCertLog($agentRunId, 'H4', 'CertificationController.php:submit', 'learner_not_found', [
                'id_number_len' => strlen($id),
            ]);
            // #endregion
            $message = 'This ID number was not found in our records. If you believe this is an error, please contact support.';
            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'errors' => ['id_number' => [$message]],
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors(['id_number' => $message]);
        }

        $name = trim($learner['name']) ?: trim($validated['name'] ?? '');
        $surname = trim($learner['surname']) ?: trim($validated['surname'] ?? '');
        if ($name === '' && $surname === '') {
            // #region agent log
            $this->agentDebugCertLog($agentRunId, 'H4', 'CertificationController.php:submit', 'learner_missing_names', []);
            // #endregion
            $message = 'Your learner record has no name on file. Please contact support.';
            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'errors' => ['id_number' => [$message]],
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors(['id_number' => $message]);
        }

        $cert = trim($learner['certificate_number'] ?? '');

        // #region agent log
        $this->agentDebugCertLog($agentRunId, 'H4', 'CertificationController.php:submit', 'learner_resolved', [
            'name_len' => strlen($name),
            'surname_len' => strlen($surname),
            'cert_no_len' => strlen($cert),
        ]);
        // #endregion

        $payload = [
            'name' => $name,
            'surname' => $surname,
            'id_number' => $id,
            'certificate_number' => $cert,
            'email' => $validated['email'] ?? null,
        ];

        $token = GenerateCertificateJob::dispatchSync($payload);
        if (! is_string($token) || $token === '') {
            // #region agent log
            $this->agentDebugCertLog($agentRunId, 'H3', 'CertificationController.php:submit', 'job_failed_or_no_token', []);
            // #endregion
            $message = 'Certificate generation failed. Please try again or contact support.';
            if ($expectsJson) {
                return response()->json([
                    'success' => false,
                    'certificate_failed' => true,
                    'message' => $message,
                ]);
            }

            return back()->withInput()->withErrors(['certificate' => $message]);
        }

        $successUrl = route('certification.success', ['token' => $token]);
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
        } catch (Throwable $e) {
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
        $download = CertificateDownload::query()
            ->where('download_token', $token)
            ->first();
        if (! $download || $download->isExpired()) {
            return redirect()->route('certification.form')->with('error', 'Invalid or expired download link.');
        }

        $displayName = trim(trim((string) $download->name) . ' ' . trim((string) $download->surname)) ?: 'Recipient';
        return view('certification.success', [
            'name' => $displayName,
            'training_name' => config('certificates.training_name', 'Business Essentials for Entrepreneurs'),
            'download_token' => $token,
        ]);
    }

    /**
     * Download certificate by token (only the generated file is accessible; token is one-time use in practice).
     */
    public function download(Request $request)
    {
        try {
            $token = trim((string) $request->query('token', ''));
            if ($token === '') {
                return redirect()->route('certification.form')->with('error', 'Invalid download link.');
            }

            $download = CertificateDownload::query()
                ->where('download_token', $token)
                ->first();
            if (! $download || $download->isExpired()) {
                return redirect()->route('certification.form')->with('error', 'Invalid or expired download link.');
            }

            $disk = $this->effectiveCertificateStorageDiskName();
            $path = (string) $download->storage_path;
            if ($path === '' || ! Storage::disk($disk)->exists($path)) {
                return redirect()->route('certification.form')->with('error', 'Certificate not found.');
            }

            $absolute = Storage::disk($disk)->path($path);
            if (! is_readable($absolute)) {
                \Log::error('Certificate PDF not readable', ['path' => $absolute]);

                return redirect()->route('certification.form')->with('error', 'Certificate not found.');
            }

            if (Schema::hasColumn('certificate_downloads', 'downloaded_at')) {
                CertificateDownload::query()
                    ->whereKey($download->id)
                    ->whereNull('downloaded_at')
                    ->update(['downloaded_at' => now()]);
            }

            CertificatePdfEmailDelivery::trySend($download);

            // Read in-controller: Storage::download() streams on send(), which can still 500 after this returns.
            $content = @file_get_contents($absolute);
            if ($content === false || $content === '') {
                \Log::error('Certificate PDF could not be read', ['path' => $absolute]);

                return redirect()->route('certification.form')->with('error', 'Certificate not found.');
            }

            $rawName = basename(str_replace('\\', '/', $path));
            $filename = Str::ascii($rawName);
            $filename = $filename !== '' ? str_replace(["\0", '"', "\r", "\n"], '', $filename) : 'certificate.pdf';

            return response($content, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            ]);
        } catch (Throwable $e) {
            \Log::error('Certificate download failed', [
                'token_prefix' => substr((string) $request->query('token', ''), 0, 8),
                'exception' => $e->getMessage(),
            ]);

            return redirect()->route('certification.form')->with('error', 'Could not download your certificate. Please try again or contact support.');
        }
    }

    /**
     * CERTIFICATE_STORAGE_DISK= (empty) makes env return '' and breaks Storage::disk('').
     */
    private function effectiveCertificateStorageDiskName(): string
    {
        $name = trim((string) config('certificates.storage_disk', 'local'));
        if ($name === '') {
            $name = 'local';
        }

        $driver = config("filesystems.disks.{$name}.driver");
        if ($driver !== 'local' || ! is_array(config("filesystems.disks.{$name}"))) {
            return 'local';
        }

        return $name;
    }

    // #region agent log
    /**
     * Append one NDJSON debug line (session 6645e7). No PII in payload.
     */
    private function agentDebugCertLog(string $runId, string $hypothesisId, string $location, string $message, array $data): void
    {
        $dir = base_path('.cursor');
        if (! is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        $path = $dir . DIRECTORY_SEPARATOR . 'debug-6645e7.log';
        $payload = [
            'sessionId' => '6645e7',
            'runId' => $runId,
            'hypothesisId' => $hypothesisId,
            'location' => $location,
            'message' => $message,
            'data' => $data,
            'timestamp' => (int) round(microtime(true) * 1000),
        ];
        @file_put_contents($path, json_encode($payload, JSON_UNESCAPED_SLASHES) . "\n", FILE_APPEND | LOCK_EX);
    }
    // #endregion
}
