<?php

namespace App\Mail;

use App\Models\CertificateDownload;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CertificateDeliveredMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CertificateDownload $download,
        public string $trainingName
    ) {}

    public function build(): self
    {
        $disk = config('certificates.storage_disk', 'certificates_local');
        $relative = (string) $this->download->storage_path;
        $absolute = $relative !== '' ? Storage::disk($disk)->path($relative) : '';

        $displayName = trim(trim((string) $this->download->name) . ' ' . trim((string) $this->download->surname));
        if ($displayName === '') {
            $displayName = 'there';
        }

        $logoUrl = rtrim((string) config('app.url'), '/') . '/images/kayise-logo.png';

        $mail = $this->subject('Your KAYISE IT certificate — ' . $this->trainingName)
            ->replyTo('info@kayiseit.com', 'KAYISE IT')
            ->view('emails.certificate-delivered', [
                'displayName' => $displayName,
                'trainingName' => $this->trainingName,
                'pdfFilename' => $relative !== '' ? basename($relative) : 'certificate.pdf',
                'logoUrl' => $logoUrl,
            ]);

        if ($relative !== '' && is_file($absolute)) {
            $mail->attach($absolute, [
                'as' => basename($relative),
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}
