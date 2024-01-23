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
        return $this->view('emails.application_notification');
    }
}

