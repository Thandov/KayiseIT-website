<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
            $client = new Client();
            $client->name = $validatedData['first_name'];
            $client->surname = $validatedData['last_name'];
            $client->phone = $validatedData['phone'];
            $client->email = $request->email;            
            $client->user_id = Auth::user()->id;  
            $client->address = $validatedData['address'];
            $client->company = $validatedData['company'];
            $client->province = $validatedData['province'];
            // Set values for additional fields

            $client->save();
            $clientId = $client->user_id;
            if ($request->ajax()) {
                return response()->json(['message' => 'Client created successfully.']);
            }

            return redirect()->route('admin.dashboard.clients.viewclient', ['id' => $clientId])->with('success', 'Client created successfully.');
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
            ->select('users.name AS first_name', 'users.surname AS last_name', 'users.phone', 'users.email', 'clients.*')
            ->first();
            dd($id);  
        return view('admin/dashboard/clients/viewclient', compact('client'));
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
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ]);
        
        $client = Client::where('user_id', $request->user_id)->first();
        $user = User::find($request->user_id);
        $changedFields = [];

        if ($user->name !== $validatedData['first_name']) {
            $user->name = $validatedData['first_name'];
            $changedFields[] = 'first_name';
        }

        if ($user->surname !== $validatedData['last_name']) {
            $user->surname = $validatedData['last_name'];
            $changedFields[] = 'last_name';
        }

        if ($user->email !== $validatedData['email']) {
            $user->email = $validatedData['email'];
            $changedFields[] = 'email';
        }
        if ($user->phone !== $validatedData['phone']) {
            $user->phone = $validatedData['phone'];
            $changedFields[] = 'phone';
        }
        // Save the user model if any changes were made to the "users" table fields
        if (!empty($changedFields)) {
            $user->save();
        }

        if ($client->company !== $validatedData['company']) {
            $client->company = $validatedData['company'];
            $changedFields[] = 'company';
        }
        
        if ($client->address !== $validatedData['address']) {
            $client->address = $validatedData['address'];
            $changedFields[] = 'address';
        }

        if ($client->province !== $validatedData['province']) {
            $client->province = $validatedData['province'];
            $changedFields[] = 'province';
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
    public function destroy(Request $request, $id)
    {

        $id = (int)$id;
        $client = DB::table('clients')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $client->user_id)->first();

        if ($client && $user) {
            // Perform your desired operations with the $client and $user models

            // Delete the client
            DB::table('clients')->where('id', $id)->delete();

            // Delete the associated user
            DB::table('users')->where('id', $client->user_id)->delete();

            if ($request->ajax()) {
                return response()->json(['message' => 'client and associated user have been deleted.']);
            }

            return redirect()->route('admin.dashboard.clients')->with('success', 'client and associated user have been deleted.');
        } else {
            if ($request->ajax()) {
                return response()->json(['message' => 'client or associated user not found.'], 404);
            }

            return redirect()->route('admin.dashboard.clients')->with('error', 'client or associated user not found.');
        }
    }
    /**
     * Show newly registered clients created within the last day.
     *
     * @return \Illuminate\Http\Response
     */
    public function brandNewClients()
    {
        // Calculate the date one day ago from now
        $oneDayAgo = Carbon::now()->subDay();

        // Retrieve clients created within the last day
        return Client::where('created_at', '>=', $oneDayAgo)->get();
    }
}