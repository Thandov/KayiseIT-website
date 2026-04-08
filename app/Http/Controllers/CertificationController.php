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
            'certificate_number' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $name = trim($validated['name']);
        $surname = trim($validated['surname']);
        $id = trim($validated['id_number']);
        $cert = trim($validated['certificate_number']);
        $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
        $safeSurname = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $surname);
        $filename = "Certificate_{$safeName}_{$safeSurname}.pdf";

        // 1. Write temp CSV
        $tempDir = storage_path('app/certificates/temp');
        if (!is_dir($tempDir)) mkdir($tempDir, 0775, true);
        $tempCsv = $tempDir . '/cert_' . uniqid() . '.csv';
        $csvContent = "Name,Surname,ID number,Certificate number\n\"$name\",\"$surname\",\"$id\",\"$cert\"\n";
        file_put_contents($tempCsv, $csvContent);

        // 2. Call Python script
        $python = config('certificates.python_binary', 'python3');
        $basePath = config('certificates.python_base_path');
        $script = rtrim($basePath, '/\\') . DIRECTORY_SEPARATOR . config('certificates.python_script');
        $outputDir = storage_path('app/certificates/output');
        if (!is_dir($outputDir)) mkdir($outputDir, 0775, true);
        $date = date('d/m/Y');
        $cmd = "$python \"$script\" \"$tempCsv\" --output-dir \"$outputDir\" --date \"$date\"";
        $output = [];
        $returnVar = 0;
        exec($cmd, $output, $returnVar);


        // 3. Find the generated PDF in the correct subfolder
        $pdfPath = null;
        $subdirs = glob($outputDir . DIRECTORY_SEPARATOR . 'cert_*', GLOB_ONLYDIR);
        usort($subdirs, function($a, $b) { return filemtime($b) - filemtime($a); }); // newest first
        foreach ($subdirs as $subdir) {
            $candidate = $subdir . DIRECTORY_SEPARATOR . $filename;
            if (file_exists($candidate)) {
                $pdfPath = $candidate;
                break;
            }
        }
        if (!$pdfPath) {
            \Log::error('Certificate generation failed (PDF not found in subfolders)', [
                'cmd' => $cmd,
                'output' => $output,
                'returnVar' => $returnVar,
                'searched' => $subdirs,
                'filename' => $filename,
            ]);
            return back()->withInput()->withErrors(['certificate' => 'Certificate generation failed. Please try again or contact support.']);
        }

        // 4. Move PDF to public/certificates for download
        $publicDir = public_path('certificates');
        if (!is_dir($publicDir)) mkdir($publicDir, 0775, true);
        $publicPdfPath = $publicDir . DIRECTORY_SEPARATOR . $filename;
        copy($pdfPath, $publicPdfPath);

        // 5. Redirect to congratulations page with all params
        return redirect()->route('certification.success', [
            'name' => $name,
            'surname' => $surname,
            'id' => $id,
            'cert' => $cert,
        ]);
    }

    /**
     * Show congratulations page after successful certificate generation (confetti, download button).
     */
    public function success(Request $request): View|\Illuminate\Http\RedirectResponse
    {
        $name = $request->query('name');
        $surname = $request->query('surname');
        if (!$name || !$surname) {
            return redirect()->route('certification.form')->with('error', 'Invalid link.');
        }
        return view('certification.success', [
            'name' => trim($name . ' ' . $surname),
            'training_name' => config('certificates.training_name', 'Business Essentials for Entrepreneurs'),
            'download_name' => $name,
            'download_surname' => $surname,
        ]);
    }

    /**
     * Download certificate by token (only the generated file is accessible; token is one-time use in practice).
     */
    public function download(Request $request)
    {
        $name = $request->query('name');
        $surname = $request->query('surname');
        if (!$name || !$surname) {
            return redirect()->route('certification.form')->with('error', 'Missing name or surname.');
        }
        $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', trim($name));
        $safeSurname = preg_replace('/[^a-zA-Z0-9_\-]/', '_', trim($surname));
        $filename = "Certificate_{$safeName}_{$safeSurname}.pdf";
        $path = public_path("certificates/{$filename}");
        if (!file_exists($path)) {
            return redirect()->route('certification.form')->with('error', 'Certificate not found.');
        }
        return response()->download($path, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
