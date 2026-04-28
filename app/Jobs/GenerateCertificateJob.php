<?php

namespace App\Jobs;

use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class GenerateCertificateJob
{
    use Dispatchable, Queueable, SerializesModels;

    public int $tries = 2;
    public int $timeout = 120;

    /**
     * @param array{name: string, surname: string, id_number: string, certificate_number: string, email: string|null} $learner
     */
    public function __construct(
        protected array $learner,
        protected ?string $downloadToken = null
    ) {
        $this->downloadToken = $downloadToken ?? bin2hex(random_bytes(24));
    }

    public function handle(): ?string
    {
        $basePath = rtrim(config('certificates.python_base_path'), '/\\');
        $scriptName = config('certificates.python_script', 'certificate_template.py');
        $scriptPath = $basePath . DIRECTORY_SEPARATOR . $scriptName;
        $pythonBinary = config('certificates.python_binary', 'python3');
        $timeoutSeconds = config('certificates.process_timeout_seconds', 60);

        // Normalize Python binary path on Windows
        if (PHP_OS_FAMILY === 'Windows') {
            $pythonBinary = str_replace('/', '\\', $pythonBinary);
        }

        $disk = config('certificates.storage_disk', 'local');
        $tempSubdir = config('certificates.temp_subdir', 'certificates/temp');
        $outputSubdir = config('certificates.output_subdir', 'certificates/output');

        $tempDir = rtrim(Storage::disk($disk)->path($tempSubdir), '/\\') . DIRECTORY_SEPARATOR;
        $outputDir = rtrim(Storage::disk($disk)->path($outputSubdir), '/\\') . DIRECTORY_SEPARATOR;

        if (! is_readable($scriptPath)) {
            Log::error('Certificate generation: Python script not found or not readable', ['path' => $scriptPath]);
            return null;
        }

        $name = $this->learner['name'] ?? '';
        $surname = $this->learner['surname'] ?? '';
        $idNumber = $this->learner['id_number'] ?? '';
        $certNo = $this->learner['certificate_number'] ?? 'UE25401';
        $courseName = config('certificates.training_name', 'Business Essentials for Entrepreneurs');
        $logoPath = public_path(config('certificates.logo_path', 'images/kayise_IT_logo_No_Background.png'));
        $fullName = trim($name . ' ' . $surname) ?: 'Recipient';
        $safeName = substr(str_replace(['/', ' '], ['-', '_'], $fullName), 0, 50);

        $stem = 'cert_' . substr(str_replace(['-', '.'], '', $this->downloadToken), 0, 16);
        $tempCsvPath = $tempDir . $stem . '.csv';

        if (! is_dir($tempDir)) {
            if (! @mkdir($tempDir, 0755, true) && ! is_dir($tempDir)) {
                Log::error('Certificate generation: Could not create temp dir', ['path' => $tempDir]);
                return null;
            }
        }
        if (! is_dir($outputDir)) {
            if (! @mkdir($outputDir, 0755, true) && ! is_dir($outputDir)) {
                Log::error('Certificate generation: Could not create output dir', ['path' => $outputDir]);
                return null;
            }
        }

        $csvHeaders = [
            CertificateEligibilityService::CSV_NAME,
            CertificateEligibilityService::CSV_SURNAME,
            CertificateEligibilityService::CSV_ID,
            CertificateEligibilityService::CSV_CERT_NO,
        ];
        $csvRow = [$name, $surname, $idNumber, $certNo];
        $handle = fopen($tempCsvPath, 'w');
        if ($handle === false) {
            Log::error('Certificate generation: Could not create temp CSV', ['path' => $tempCsvPath]);
            return null;
        }
        fputcsv($handle, $csvHeaders);
        fputcsv($handle, $csvRow);
        fclose($handle);

        $quotedPython = escapeshellarg($pythonBinary);
        $quotedScript = escapeshellarg($scriptPath);
        $quotedCsv = escapeshellarg($tempCsvPath);
        $quotedOutput = escapeshellarg($outputDir);
        $quotedCourseName = escapeshellarg($courseName);
        $quotedLogoPath = escapeshellarg($logoPath);
        $command = sprintf(
            '%s %s %s --output-dir %s --course-name %s --logo-path %s',
            $quotedPython,
            $quotedScript,
            $quotedCsv,
            $quotedOutput,
            $quotedCourseName,
            $quotedLogoPath
        );

        $process = Process::fromShellCommandline($command);
        $process->setTimeout($timeoutSeconds);
        $process->run();

        @unlink($tempCsvPath);

        if (! $process->isSuccessful()) {
            Log::error('Certificate generation: Python process failed', [
                'command' => $command,
                'output' => $process->getOutput(),
                'error' => $process->getErrorOutput(),
            ]);
            return null;
        }

        $expectedPdfPath = $outputDir . $stem . DIRECTORY_SEPARATOR . 'Certificate_' . $safeName . '.pdf';
        if (! file_exists($expectedPdfPath)) {
            Log::error('Certificate generation: PDF not created at expected path', ['path' => $expectedPdfPath]);
            return null;
        }

        $relativePath = $outputSubdir . '/' . $stem . '/Certificate_' . $safeName . '.pdf';

        $expiresAt = now()->addHours(config('certificates.download_token_expiry_hours', 24));
        CertificateDownload::create([
            'id_number' => $idNumber,
            'name' => $name,
            'surname' => $surname,
            'email' => $this->learner['email'] ?? null,
            'storage_path' => $relativePath,
            'download_token' => $this->downloadToken,
            'expires_at' => $expiresAt,
        ]);

        return $this->downloadToken;
    }
}
