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
    protected $idCopyPath;
    protected $proofOfPaymentPath;

    public function __construct(InternshipApplication $internship, $applicantName, $idCopyPath, $proofOfPaymentPath)
    {
        $this->internship = $internship;
        $this->applicantName = $applicantName;
        $this->idCopyPath = $idCopyPath;
        $this->proofOfPaymentPath = $proofOfPaymentPath;
    }


    public function build()
    {
        return $this->subject('Internship Application: ' . $this->applicantName)->view('emails.new_internship_notification', ['internship' => $this->internship])
            ->from(auth()->user()->email, 'Internship Application')
            ->attach($this->idCopyPath)
            ->attach($this->proofOfPaymentPath);
    }
}
