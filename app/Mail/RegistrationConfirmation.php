<?php

namespace App\Mail;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Person $person) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address('info@kayiseit.co.za', 'KAYISE IT'),
            subject: 'Registration Confirmed – ' . ($this->person->program->name ?? 'KAYISE IT Programme'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration_confirmation',
        );
    }
}
