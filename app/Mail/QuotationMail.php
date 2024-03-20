<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->view('info@kayiseit.co.za')
                    ->subject('KAYISE IT - Quotation for ' . $this->emailData['service_name'])
                    ->view('emails.quotation')
                    ->with('emailData', $this->emailData);
    }
}

