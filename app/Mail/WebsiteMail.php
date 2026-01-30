<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\QuotationRequest;

class WebsiteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public string $type, public string $pages, public string $hosting, public string $maintenance,  public string $pages_price, public string $hosting_price, public string $maintenance_price, public string $total)
    {
        //
    }

    public function build()
    {
        return $this->subject('Congratulations')->markdown('emails.webquote');
    }

}
