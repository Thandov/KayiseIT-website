<?php

namespace App\Services;

use App\Mail\CertificateDeliveredMail;
use App\Models\CertificateDownload;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Throwable;

class CertificatePdfEmailDelivery
{
    /**
     * Email the certificate PDF once when the learner downloads it (if email is on file).
     */
    public static function trySend(CertificateDownload $download): void
    {
        $email = trim((string) $download->email);
        if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        if (
            Schema::hasColumn('certificate_downloads', 'certificate_pdf_emailed_at')
            && $download->certificate_pdf_emailed_at !== null
        ) {
            return;
        }

        try {
            Mail::to($email)->send(new CertificateDeliveredMail(
                $download,
                (string) config('certificates.training_name', 'Business Essentials for Entrepreneurs')
            ));

            if (Schema::hasColumn('certificate_downloads', 'certificate_pdf_emailed_at')) {
                CertificateDownload::query()
                    ->whereKey($download->id)
                    ->whereNull('certificate_pdf_emailed_at')
                    ->update(['certificate_pdf_emailed_at' => now()]);
            }
        } catch (Throwable $e) {
            \Log::error('Certificate PDF email on download failed', [
                'token_prefix' => substr((string) $download->download_token, 0, 8),
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
