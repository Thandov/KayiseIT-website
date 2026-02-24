<?php

namespace App\Jobs;

use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class GenerateCertificateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        $quotedScript = escapeshellarg($scriptPath);
        $quotedCsv = escapeshellarg($tempCsvPath);
        $quotedOutput = escapeshellarg($outputDir);
        $command = sprintf('%s %s %s --output-dir %s', $pythonBinary, $quotedScript, $quotedCsv, $quotedOutput);

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
