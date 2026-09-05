<?php

namespace App\Http\Controllers;

use App\Helpers\StaffFolderHelper;
use App\Mail\StaffRegistrationInvite;
use App\Models\Employee;
use App\Models\StaffInvite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class StaffInviteController extends Controller
{
    public function sendInvites(Request $request)
    {
        $validated = $request->validate([
            'emails' => 'required|array|min:1',
            'emails.*' => 'required|email',
        ]);

        $emails = collect($validated['emails'])
            ->map(fn ($email) => strtolower(trim($email)))
            ->unique()
            ->values();

        $skipped = [];
        $sent = 0;

        foreach ($emails as $email) {
            if (Employee::where('email', $email)->exists()) {
                $skipped[] = "{$email} (already registered as staff)";
                continue;
            }

            if (User::where('email', $email)->exists()) {
                $skipped[] = "{$email} (email already in use)";
                continue;
            }

            if (StaffInvite::hasPendingInvite($email)) {
                $skipped[] = "{$email} (invite already pending)";
                continue;
            }

            $invite = StaffInvite::create([
                'email' => $email,
                'token' => StaffInvite::generateToken(),
                'invited_by' => $request->user()?->id,
                'expires_at' => now()->addDays(7),
            ]);

            try {
                Mail::mailer(\App\Helpers\StaffEmailHelper::outboundMailer())->to($email)->send(new StaffRegistrationInvite($invite));
                $sent++;
            } catch (\Throwable $e) {
                Log::error('Staff invite email failed', [
                    'email' => $email,
                    'error' => $e->getMessage(),
                ]);
                $invite->delete();
                $skipped[] = "{$email} (failed to send email)";
            }
        }

        if ($sent === 0 && count($skipped) > 0) {
            return back()->with('error', 'No invites were sent. ' . implode('; ', $skipped));
        }

        $message = "{$sent} registration " . ($sent === 1 ? 'link was' : 'links were') . ' emailed successfully.';

        if (count($skipped) > 0) {
            $message .= ' Skipped: ' . implode('; ', $skipped);
        }

        return back()->with('success', $message);
    }

    public function showRegistrationForm(string $token)
    {
        $invite = StaffInvite::findValidByToken($token);

        if (! $invite) {
            return view('staff.register-invalid');
        }

        return view('staff.register', compact('invite'));
    }

    public function submitRegistration(Request $request, string $token)
    {
        $invite = StaffInvite::findValidByToken($token);

        if (! $invite) {
            return view('staff.register-invalid');
        }

        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|in:' . $invite->email,
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'ID_number' => 'required|string|min:13|max:13|unique:employees,ID_number',
                'date_of_birth' => 'nullable|date',
                'password' => 'required|string|min:8|confirmed',
                'id_verifi_doc' => 'nullable|boolean',
                'proof_address_verifi_doc' => 'nullable|boolean',
                'bank_confi_verifi' => 'nullable|boolean',
            ]);

            StaffFolderHelper::ensureDirectory($validatedData['first_name'], $validatedData['last_name']);

            $profilePicturePath = null;
            if ($request->file('profile_picture')) {
                $profilePicture = $request->file('profile_picture');
                if (! $profilePicture->isValid()) {
                    throw ValidationException::withMessages([
                        'profile_picture' => StaffFolderHelper::uploadErrorMessage($profilePicture),
                    ]);
                }

                $profilePicturePath = StaffFolderHelper::storeUpload(
                    $profilePicture,
                    $validatedData['first_name'],
                    $validatedData['last_name']
                );
            }

            DB::transaction(function () use ($validatedData, $invite, $profilePicturePath) {
                $user = User::create([
                    'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                    'email' => $invite->email,
                    'password' => bcrypt($validatedData['password']),
                ]);
                $user->forceFill(['email_verified_at' => now()])->save();
                try {
                    $user->attachRole('staff');
                } catch (\Throwable $e) {
                    \Log::warning('Could not attach staff role on invite accept: '.$e->getMessage());
                }

                Employee::create([
                    'user_id' => $user->id,
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'email' => $invite->email,
                    'phone' => $validatedData['phone'],
                    'address' => $validatedData['address'],
                    'province' => $validatedData['province'],
                    'ID_number' => $validatedData['ID_number'],
                    'profile_picture' => $profilePicturePath,
                    'id_verifi_doc' => $validatedData['id_verifi_doc'] ?? false,
                    'proof_address_verifi_doc' => $validatedData['proof_address_verifi_doc'] ?? false,
                    'bank_confi_verifi' => $validatedData['bank_confi_verifi'] ?? false,
                    'date_of_birth' => $validatedData['date_of_birth'],
                ]);

                $invite->update(['accepted_at' => now()]);
            });

            return redirect()->route('login')->with('success', 'Your staff registration is complete. You can now log in with your email and password.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
