<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationNotification extends Mailable
{
    public $request, $quotationData;

    public function __construct($request, $quotationData)
    {
        $this->request = $request;
        $this->quotationData = $quotationData;
    }

    public function build()
{
    $subject = 'Drone Application - ' . $this->request->name . ' ' . $this->request->surname;
    return $this->view('emails.application_notification')
        ->subject($subject)
        ->from(auth()->user()->email, 'Drone Application - ' . $this->request->name . ' ' . $this->request->surname);
    
}
}