<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use App\Models\InternshipApplication;
use App\Helpers\UserFolderHelper;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Create a cookie with the SameSite attribute
        $cookie = Cookie::make('my_cookie', 'cookie_value', 60)
            ->withSameSite('None'); // Specify SameSite attribute here

        return view('auth.register')->withCookie($cookie);
    }
    public function createapplicant()
    {
        // Create a cookie with the SameSite attribute
        $cookie = Cookie::make('my_cookie', 'cookie_value', 60)
            ->withSameSite('None'); // Specify SameSite attribute here

        return view('auth.registerapplicant')->withCookie($cookie);
    }
    public function createintern()
    {
        if ($programId = request()->integer('program')) {
            session(['apply_program_id' => $programId]);
        }

        $cookie = Cookie::make('my_cookie', 'cookie_value', 60)
            ->withSameSite('None');

        return view('auth.registerintern')->withCookie($cookie);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
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

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null, // Set email_verified_at to null initially
        ]);

        // Attach role only if one was provided and exists
        if ($request->filled('role_id') && Role::whereKey($request->role_id)->exists()) {
            $user->attachRole((int) $request->role_id);
        }

        // Create user folder based on role/opportunity type
        UserFolderHelper::createUserFolder($user, 'general');

        event(new Registered($user));



        // Do not log in or send email. Redirect to login page with success message.
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function storeapplicant(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
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

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null, // Set email_verified_at to null initially
        ]);
        $user->attachRole('client');

        // Create user folder for training opportunity
        UserFolderHelper::createUserFolder($user, 'training');

        //event(new Registered($user));



        // Do not log in or send email. Redirect to login page with success message.
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function storeintern(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null, // Set email_verified_at to null initially
        ]);
        $user->attachRole('applicant');

        // Create user folder for internship opportunity
        UserFolderHelper::createUserFolder($user, 'internship');

        //event(new Registered($user));

        return redirect()->route('loginintern')->with('success', 'Registration successful. Please log in to complete your application.');
    }
}
