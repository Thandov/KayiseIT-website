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
            ->select('clients.name AS first_name', 'users.email', 'clients.*')
            ->get();
            
        return view('admin.dashboard.clients.index', compact('clients'));
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
            $clientId = $client->id;
            if ($request->ajax()) {
                return response()->json(['message' => 'Client created successfully.']);
            }
            return redirect()->route('dashboard.clients.viewclient', ['id' => $clientId])
                ->with('success', 'Client created successfully.');
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
        // $client = DB::table('clients')
        //     ->join('users', 'users.id', '=', 'clients.user_id')
        //     ->where('clients.user_id', (int)$id)
        //     ->select('users.name AS first_name', 'users.surname AS last_name', 'users.phone', 'users.email', 'clients.*')
        //     ->first();

            $client = Client::find($id);
        $user = User::where('id', $client->user_id)->get();

            // dd($user);
        return view('admin/dashboard/clients/viewclient', compact('client', 'user'));
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
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Find client by user_id
        $client = Client::where('user_id', $request->user_id)->first();
        
        if (!$client) {
            return redirect()->back()->with('error', 'Client not found.');
        }
        
        $user = User::find($request->user_id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $changedFields = [];
        
        if ($user->name !== $validatedData['first_name']) {
            $user->name = $validatedData['first_name'];
            $changedFields[] = 'name';
        }

        if ($user->surname !== $validatedData['last_name']) {
            $user->surname = $validatedData['last_name'];
            $changedFields[] = 'surname';
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

        if ($client->name !== $validatedData['first_name']) {
            $client->name = $validatedData['first_name'];
            $changedFields[] = 'name';
        }

        if ($client->surname !== $validatedData['last_name']) {
            $client->surname = $validatedData['last_name'];
            $changedFields[] = 'surname';
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
        // Handle JSON input for selected_ids
        $selectedIdsJson = $request->input('selected_ids');
        if (!empty($selectedIdsJson)) {
            $ids = json_decode($selectedIdsJson, true);
            if (!is_array($ids)) {
                $ids = [$ids];
            }
        } else {
            $ids = [$id];
        }
        
        if (empty($ids)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'No clients selected.'], 400);
            }
            return redirect()->route('dashboard.clients')->with('error', 'No clients selected.');
        }

        // Get user IDs before deleting clients
        $userIds = DB::table('clients')
            ->whereIn('id', $ids)
            ->pluck('user_id')
            ->toArray();

        // Delete the selected clients
        $deleted = DB::table('clients')->whereIn('id', $ids)->delete();

        // Delete the associated users (only if they exist and are not used elsewhere)
        if (!empty($userIds)) {
            // Check if users are only associated with these clients
            foreach ($userIds as $userId) {
                $remainingClients = DB::table('clients')->where('user_id', $userId)->count();
                if ($remainingClients === 0) {
                    // Only delete user if no other clients are associated
                    DB::table('users')->where('id', $userId)->delete();
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Selected clients have been deleted successfully.',
                'deleted_count' => $deleted
            ]);
        }

        $message = count($ids) === 1 
            ? 'Client has been deleted successfully.' 
            : count($ids) . ' clients have been deleted successfully.';

        return redirect()->route('dashboard.clients')->with('success', $message);
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
