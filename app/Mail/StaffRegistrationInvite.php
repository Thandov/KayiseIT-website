<?php

namespace App\Mail;

use App\Models\StaffInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StaffRegistrationInvite extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public StaffInvite $invite) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address', 'info@kayiseit.com'),
                config('mail.from.name', 'KAYISE IT')
            ),
            subject: 'Complete your KAYISE IT staff registration',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.staff_registration_invite',
        );
    }
}
