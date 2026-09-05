<?php

namespace App\Mail;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StaffAccountActivation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Employee $employee,
        public User $user,
        public string $resetUrl,
        public string $deliveryEmail
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address', 'info@kayiseit.com'),
                config('mail.from.name', 'KAYISE IT')
            ),
            subject: 'Activate your KAYISE IT staff account',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.staff_account_activation',
        );
    }
}
