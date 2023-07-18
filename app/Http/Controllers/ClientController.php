<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('clients')
        ->join('users', 'users.id', '=', 'clients.user_id')
        ->select('users.name AS first_name', 'users.email', 'clients.*')
        ->get();

        return view('/admin/clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                //'email' => 'required|email|unique:clients',
                'phone' => 'required|string',
                'address' => 'required|string',
                'company' => 'required|string',
                'province' => 'required|string',
            ]);

            // Create a new user
            $user = new User();
            $user->name = $validatedData['first_name'];
            $user->password = bcrypt('K@y1s31T'); // Set the temporary password
            $user->email = $request->email;
            // Set values for other user fields
            $user->save();
            $client = new Client();
            $client->user_id = $user->id;
            $client->phone = $validatedData['phone'];
            $client->address = $validatedData['address'];
            $client->company = $validatedData['company'];
            // Set values for additional fields

            $client->save();
            $clientId = $client->user_id;
            if ($request->ajax()) {
                return response()->json(['message' => 'Client created successfully.']);
            }

            return redirect()->route('admin.clients.viewclient', ['id' => $clientId])->with('success', 'Client created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = DB::table('clients')
        ->join('users', 'users.id', '=', 'clients.user_id')
        ->where('clients.user_id', (int)$id)
            ->select('users.name AS first_name', 'users.email', 'clients.*')
            ->first();

        return view('admin/clients/viewclient', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
dd();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'ID_number' => 'required|min:13|max:13|',
            'date_of_birth' => 'required|date',
            // Add validation rules for other fields as needed
        ]);

        $client = Client::where('user_id', $request->user_id)->first();
        $changedFields = [];


        if ($client->first_name !== $validatedData['first_name']) {
            $client->first_name = $validatedData['first_name'];
            $changedFields[] = 'first_name';
        }

        if ($client->last_name !== $validatedData['last_name']) {
            $client->last_name = $validatedData['last_name'];
            $changedFields[] = 'last_name';
        }

        if ($client->email !== $validatedData['email']) {
            $client->email = $validatedData['email'];
            $changedFields[] = 'email';
        }

        if ($client->phone !== $validatedData['phone']) {
            $client->phone = $validatedData['phone'];
            $changedFields[] = 'phone';
        }

        if ($client->address !== $validatedData['address']) {
            $client->address = $validatedData['address'];
            $changedFields[] = 'address';
        }

        if ($client->province !== $validatedData['province']) {
            $client->province = $validatedData['province'];
            $changedFields[] = 'province';
        }

        if ($client->ID_number !== $validatedData['ID_number']) {
            $client->ID_number = $validatedData['ID_number'];
            $changedFields[] = 'ID_number';
        }

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
            $client->profile_picture = $profilePicturePath;
            $changedFields[] = 'profile_picture';
        }

        $client->id_verifi_doc = $validatedData['id_verifi_doc'] ?? false;
        $client->proof_address_verifi_doc = $validatedData['proof_address_verifi_doc'] ?? false;
        $client->bank_confi_verifi = $validatedData['bank_confi_verifi'] ?? false;

        if ($client->date_of_birth !== $validatedData['date_of_birth']) {
            $client->date_of_birth = $validatedData['date_of_birth'];
            $changedFields[] = 'date_of_birth';
        }

        if (!empty($changedFields)) {
            $client->save();
        }

        return redirect()->back()->with('success', 'client updated successfully.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}