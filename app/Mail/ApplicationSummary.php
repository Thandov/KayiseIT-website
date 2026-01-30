<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $quotationData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quotationData)
    {
        $this->quotationData = $quotationData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.application_summary')
            ->subject('KAYISE IT - Drone Application Summary')
            ->from('info@kayiseit.com', 'KAYISE IT');
    }
}
