<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\SubscribeMail;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::check()) {
        $user = Auth::user();
        $subscription = new Subscription;
        $subscription->name = $user->name;
        $subscription->email = $user->email;
        $subscription->save();
        // Send the email
        Mail::to('info@kayiseit.co.za')->send(new SubscribeMail($subscription));

    } else {

        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $subscription = new Subscription;
        $subscription->email = $request->email;
        $subscription->save();
        // Send the email
        Mail::to('info@kayiseit.co.za')->send(new SubscribeMail($validatedData));
    }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent.');
    }

}
