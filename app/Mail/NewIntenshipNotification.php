<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\InternshipApplication;

class NewIntenshipNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $internship;
    protected $applicantName;

    public function __construct(InternshipApplication $internship, $applicantName)
    {
        $this->internship = $internship;
        $this->applicantName = $applicantName;
    }

    public function build()
    {
        return $this->subject('Internship Application: ' . $this->applicantName)->view('emails.new_internship_notification', ['internship' => $this->internship])
            ->from(auth()->user()->email, 'Internship Application');
    }
}
