<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateSupportRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param array{id_number: string, name: string, surname: string, email: string} $payload
     */
    public function __construct(public array $payload)
    {
    }

    public function build(): self
    {
        $name = trim($this->payload['name'] . ' ' . $this->payload['surname']);

        return $this->subject('LMS certificate support — PDF generation failed')
            ->replyTo($this->payload['email'], $name !== '' ? $name : 'Learner')
            ->view('emails.certificate-support', ['payload' => $this->payload]);
    }
}
