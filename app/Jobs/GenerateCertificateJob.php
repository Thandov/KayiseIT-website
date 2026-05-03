<?php

namespace App\Jobs;

use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
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
        self::configureCertificateDiskRoot();

        $basePath = rtrim(config('certificates.python_base_path'), '/\\');
        $scriptName = config('certificates.python_script', 'certificate_template.py');
        $scriptPath = $basePath . DIRECTORY_SEPARATOR . $scriptName;
        $pythonBinary = config('certificates.python_binary', 'python3');
        $timeoutSeconds = config('certificates.process_timeout_seconds', 60);

        // Normalize Python binary path on Windows
        if (PHP_OS_FAMILY === 'Windows') {
            $pythonBinary = str_replace('/', '\\', $pythonBinary);
        }

        $disk = config('certificates.storage_disk', 'certificates_local');
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
        $logoPath = public_path(config('certificates.logo_path', 'images/kayise-logo.png'));
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
        $quotedDate = escapeshellarg(date('d/m/Y'));
        $command = sprintf(
            '%s %s %s --output-dir %s --course-name %s --logo-path %s --date %s',
            $quotedPython,
            $quotedScript,
            $quotedCsv,
            $quotedOutput,
            $quotedCourseName,
            $quotedLogoPath,
            $quotedDate
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

    /**
     * When storage/app hits disk quota, use a deterministic temp-dir root so PDF
     * generation and download still resolve the same paths (see config/filesystems
     * disk certificates_local).
     */
    public static function configureCertificateDiskRoot(): void
    {
        $disk = (string) config('certificates.storage_disk', 'certificates_local');
        if ($disk === '') {
            return;
        }

        $driver = config("filesystems.disks.{$disk}.driver");
        if ($driver !== 'local') {
            return;
        }

        $root = self::firstWritableCertificateRoot();
        Config::set("filesystems.disks.{$disk}.root", $root);
        Storage::forgetDisk($disk);
    }

    /**
     * True if the configured certificate disk root can create a PDF temp file.
     * Call after {@see configureCertificateDiskRoot()}.
     */
    public static function canEmitCertificatePdf(): bool
    {
        self::configureCertificateDiskRoot();
        $disk = (string) config('certificates.storage_disk', 'certificates_local');
        $root = rtrim((string) config("filesystems.disks.{$disk}.root"), '/\\');

        return self::canWriteScratchFileUnder($root);
    }

    /**
     * Prefer storage/app, then CERTIFICATE_DISK_ROOT, then system temp paths (some hosts
     * quota only $HOME; if every location fails, returns storage/app as last resort).
     */
    private static function firstWritableCertificateRoot(): string
    {
        $base = storage_path('app');

        $fromEnv = env('CERTIFICATE_DISK_ROOT');
        if (is_string($fromEnv) && $fromEnv !== '') {
            $r = rtrim($fromEnv, '/\\');
            if (self::canWriteScratchFileUnder($r)) {
                return $r;
            }
        }

        if (self::canWriteScratchFileUnder($base)) {
            return rtrim($base, '/\\');
        }

        $candidates = [
            rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'kayiseit-certs-' . md5($base),
            '/var/tmp/kayiseit-certs-' . md5($base),
        ];
        foreach ($candidates as $fallback) {
            if (! is_dir($fallback)) {
                @mkdir($fallback, 0755, true);
            }
            if (self::canWriteScratchFileUnder($fallback)) {
                return rtrim($fallback, '/\\');
            }
        }

        return rtrim($base, '/\\');
    }

    /**
     * mkdir can succeed while creating a real file still hits quota — test a tiny write.
     */
    private static function canWriteScratchFileUnder(string $base): bool
    {
        $base = rtrim($base, '/\\');
        $dir = $base . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR . 'temp';
        if (! @mkdir($dir, 0755, true) && ! is_dir($dir)) {
            return false;
        }

        $file = $dir . DIRECTORY_SEPARATOR . '__w_' . bin2hex(random_bytes(6)) . '.tmp';
        if (@file_put_contents($file, '0') === false) {
            return false;
        }
        @unlink($file);

        return true;
    }
}
