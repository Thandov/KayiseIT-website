<?php

namespace App\Http\Controllers;

use App\Models\UsinaRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsinaRegistrationController extends Controller
{
    public function create()
    {
        return view('usina');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'surname' => ['required','string','max:255'],
            'id_number' => ['required','string','max:50'],
            'contact' => ['required','string','max:50'],
            'email' => ['nullable','email','max:255'],
            'address' => ['nullable','string','max:2000'],
            'dob' => ['nullable','date'],
            'unemployed' => ['nullable','in:0,1'],
            'youth' => ['nullable','in:0,1'],
            'highest_qualification' => ['nullable','string','max:255'],
            'own_business' => ['nullable','in:0,1'],
            'id_upload' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:5120'],
        ]);

        $path = null;
        if ($request->hasFile('id_upload')) {
            $path = $request->file('id_upload')->store('usina_id_uploads', 'public');
        }

        $registration = UsinaRegistration::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'id_number' => $validated['id_number'],
            'contact' => $validated['contact'],
            'email' => $validated['email'] ?? null,
            'address' => $validated['address'] ?? null,
            'dob' => $validated['dob'] ?? null,
            'unemployed' => $validated['unemployed'] ?? null,
            'youth' => $validated['youth'] ?? null,
            'highest_qualification' => $validated['highest_qualification'] ?? null,
            'own_business' => $validated['own_business'] ?? null,
            'id_upload_path' => $path,
        ]);

        return back()->with('success', 'Registration submitted successfully.');
    }
}


