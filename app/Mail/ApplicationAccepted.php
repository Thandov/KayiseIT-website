<?php

namespace App\Mail;

use App\Models\InternshipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $message;

    public function __construct(InternshipApplication $application, $message)
    {
        $this->application = $application;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Application Accepted - KAYISE IT')
                    ->view('emails.application_accepted')
                    ->from('info@kayiseit.com', 'KAYISE IT');
    }
}
