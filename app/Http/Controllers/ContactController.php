<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\SubscribeMail;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Send the email
        Mail::to('info@kayiseit.co.za')->send(new ContactFormMail($validatedData));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent.');
    }

    public function subscribe(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        // Send the email
        Mail::to('info@kayiseit.co.za')->send(new SubscribeMail($validatedData));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent.');
    }
    
}
