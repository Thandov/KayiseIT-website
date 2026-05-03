<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CertificateEligibilityService
{
    /** CSV column names used by the Python script (and in learner CSVs). */
    public const CSV_NAME = 'Name';
    public const CSV_SURNAME = 'Surname';
    public const CSV_ID = 'ID number';
    public const CSV_CERT_NO = 'Certificate number';

    protected string $basePath;
    /** @var array<int, string> */
    protected array $csvFilenames;

    public function __construct(?string $basePath = null, ?array $csvFilenames = null)
    {
        $this->basePath = $basePath ?? rtrim((string) config('certificates.python_base_path', ''), '/');
        $fromConfig = config('certificates.learner_csvs', []);
        $resolved = $csvFilenames ?? $fromConfig;
        if (! is_array($resolved)) {
            $resolved = is_string($resolved)
                ? array_values(array_filter(array_map('trim', explode(',', $resolved))))
                : [];
        }
        $this->csvFilenames = array_values(array_filter($resolved, static fn ($f) => is_string($f) && $f !== ''));
    }

    /**
     * Normalize ID for comparison (trim, remove internal spaces).
     */
    public static function normalizeId(string $id): string
    {
        return preg_replace('/\s+/', '', trim($id));
    }

    /**
     * Find learner by ID number in configured CSVs. Returns first match.
     *
     * @return array{name: string, surname: string, certificate_number: string}|null
     */
    public function findLearnerById(string $idNumber): ?array
    {
        $normalized = self::normalizeId($idNumber);
        if ($normalized === '') {
            return null;
        }

        $cacheKey = 'cert_eligibility_' . md5($normalized);
        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached === false ? null : $cached;
        }

        foreach ($this->csvFilenames as $filename) {
            $path = $this->basePath . DIRECTORY_SEPARATOR . $filename;
            if (! is_readable($path)) {
                Log::warning('Certificate eligibility: CSV not readable', ['path' => $path]);
                continue;
            }
            $row = $this->findInCsv($path, $normalized);
            if ($row !== null) {
                Cache::put($cacheKey, $row, now()->addMinutes(30));
                return $row;
            }
        }

        Cache::put($cacheKey, false, now()->addMinutes(5));
        return null;
    }

    /**
     * @return array{name: string, surname: string, certificate_number: string}|null
     */
    protected function findInCsv(string $path, string $normalizedId): ?array
    {
        $handle = fopen($path, 'r');
        if ($handle === false) {
            return null;
        }
        try {
            $header = fgetcsv($handle);
            if ($header === false) {
                return null;
            }
            $header = array_map('trim', $header);
            $idIndex = $this->columnIndex($header, self::CSV_ID);
            $nameIndex = $this->columnIndex($header, self::CSV_NAME);
            $surnameIndex = $this->columnIndex($header, self::CSV_SURNAME);
            $certIndex = $this->columnIndex($header, self::CSV_CERT_NO);
            if ($idIndex === null) {
                Log::warning('Certificate eligibility: CSV missing ID column', ['path' => $path]);
                return null;
            }
            while (($row = fgetcsv($handle)) !== false) {
                $rowId = isset($row[$idIndex]) ? self::normalizeId($row[$idIndex]) : '';
                if ($rowId === $normalizedId) {
                    $name = $nameIndex !== null && isset($row[$nameIndex]) ? trim($row[$nameIndex]) : '';
                    $surname = $surnameIndex !== null && isset($row[$surnameIndex]) ? trim($row[$surnameIndex]) : '';
                    $certNo = $certIndex !== null && isset($row[$certIndex]) ? trim($row[$certIndex]) : 'UE25401';
                    return [
                        'name' => $name,
                        'surname' => $surname,
                        'certificate_number' => $certNo ?: 'UE25401',
                    ];
                }
            }
        } finally {
            fclose($handle);
        }
        return null;
    }

    /**
     * @param array<int, string> $header
     */
    protected function columnIndex(array $header, string $columnName): ?int
    {
        foreach ($header as $i => $h) {
            if (trim($h) === $columnName) {
                return $i;
            }
        }
        return null;
    }
}
