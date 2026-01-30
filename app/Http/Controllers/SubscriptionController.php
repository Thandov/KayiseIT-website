<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;


class SubscriptionController extends Controller
{
    //
    //
    public function subscribe(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        // Create a new subscription
        Subscription::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('events')->with('message', 'Successfully subscribed!');
    }

}
