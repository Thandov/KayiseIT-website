<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\SubscribeMail;
use App\Models\Subscription;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use Illuminate\Support\Facades\Http;
use App\Models\Service;
use App\Services\ClientLeadService;
use App\Services\ServicesService;

class ContactController extends Controller
{

    protected $servicesService;

    public function __construct(ServicesService $servicesService)
    {
        $this->servicesService = $servicesService;
    }

    public function index()
    {
        // Retrieve all services using the service layer
        $services = $this->servicesService->getAllServices();

        // Return services as JSON response for the contact page
        return view('contact', compact('services'));
    }

    // If you're using an API route to fetch services
    public function getServices()
    {
        // Fetch all services from the database
        $services = Service::all();

        // Return the services as JSON
        return response()->json($services);
    }
    

    public function contact(Request $request)
    {
        
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => [
                    'required',
                    function (string $attribute, mixed $value, $fail) {
                        $g_response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                            'secret' => config('services.recaptcha.secret_key'),
                            'response' => $value,
                            'remoteip' => \request()->ip()
                        ]);
                        if (!$g_response->json('success')) {
                            $fail("The {$attribute} is invalid.");
                        }
                    },
                ],
            ]);

            $message = new Message;
            $message->name = $request->name;
            $message->email = $request->email;
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->save();

            app(ClientLeadService::class)->captureInquiry([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Send the email
            Mail::to('info@kayiseit.com')->send(new ContactFormMail($validatedData));

            return redirect()->back()->with('success', 'Your message has been sent.');
    }

    public function subscribe(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the email already exists in the subscriptions table
            $existingSubscription = Subscription::where('email', $user->email)->first();
            if ($existingSubscription) {
                return redirect()->back()->with('error', 'You have already subscribed!');
            }

            $subscription = new Subscription;
            $subscription->name = $user->name;
            $subscription->email = $user->email;
            $subscription->save();

            // Send the email
            Mail::to('info@kayiseit.com')->send(new SubscribeMail($subscription));
        } else {

            // Validate the email field
            $request->validate([
                'email' => 'required|email|unique:subscriptions,email',
            ], [
                'email.unique' => 'This email is already subscribed.',
            ]);

            $subscription = new Subscription;
            $subscription->email = $request->email;
            $subscription->save();

            // Send the email
            Mail::to('info@kayiseit.co.za')->send(new SubscribeMail($subscription));
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thanks for subscribing!');
    }
}
