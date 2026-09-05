<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{
    public function index(Request $request)
    {
        if (! auth()->user()?->canAccessClients()) {
            abort(403);
        }

        $status = $request->query('status', 'all');
        if (! in_array($status, ['all', 'lead', 'client'], true)) {
            $status = 'all';
        }

        $query = Client::query()->orderByDesc('updated_at');
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $clients = $query->get();
        $leadCount = Client::leads()->count();
        $clientCount = Client::converted()->count();

        return view('admin.dashboard.clients.index', compact(
            'clients',
            'status',
            'leadCount',
            'clientCount'
        ));
    }

    public function store(Request $request)
    {
        if (! auth()->user()?->hasStaffPermission('clients.create')) {
            abort(403);
        }

        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'status' => ['nullable', Rule::in([Client::STATUS_LEAD, Client::STATUS_CLIENT])],
            ]);

            $email = strtolower(trim($validatedData['email']));
            $client = Client::query()->whereRaw('LOWER(email) = ?', [$email])->first() ?? new Client;
            $client->name = $validatedData['first_name'];
            $client->surname = $validatedData['last_name'] ?? null;
            $client->phone = $validatedData['phone'] ?? null;
            $client->email = $email;
            $client->address = $validatedData['address'] ?? null;
            $client->company = $validatedData['company'] ?? null;
            $client->province = $validatedData['province'] ?? null;
            $status = $validatedData['status'] ?? Client::STATUS_LEAD;
            if (! $client->exists || ! $client->isConvertedClient()) {
                $client->status = $status;
            }
            if ($client->status === Client::STATUS_CLIENT && ! $client->converted_at) {
                $client->converted_at = now();
            }
            $client->save();

            if ($request->ajax()) {
                return response()->json(['message' => 'Saved.']);
            }

            return redirect()->route('dashboard.clients.viewclient', ['id' => $client->id])
                ->with('success', $status === Client::STATUS_LEAD ? 'Lead saved.' : 'Client saved.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function show($id)
    {
        if (! auth()->user()?->hasStaffPermission('clients.read')) {
            abort(403);
        }

        $client = Client::findOrFail($id);
        $user = $client->user_id ? User::where('id', $client->user_id)->get() : collect();

        return view('admin.dashboard.clients.viewclient', compact('client', 'user'));
    }

    public function update(Request $request)
    {
        if (! auth()->user()?->hasStaffPermission('clients.update')) {
            abort(403);
        }

        $validatedData = $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'status' => ['nullable', Rule::in([Client::STATUS_LEAD, Client::STATUS_CLIENT])],
            'user_id' => 'nullable|integer',
        ]);

        $client = Client::findOrFail($validatedData['client_id']);

        $client->name = $validatedData['first_name'];
        $client->surname = $validatedData['last_name'] ?? null;
        $client->email = $validatedData['email'];
        $client->phone = $validatedData['phone'] ?? null;
        $client->company = $validatedData['company'] ?? null;
        $client->address = $validatedData['address'] ?? null;
        $client->province = $validatedData['province'] ?? null;

        $nextStatus = $validatedData['status'] ?? $client->status;
        $client->status = $nextStatus;
        if ($nextStatus === Client::STATUS_CLIENT && ! $client->converted_at) {
            $client->converted_at = now();
        }
        $client->save();

        $userId = $validatedData['user_id'] ?? $client->user_id;
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $user->name = $validatedData['first_name'];
                $user->surname = $validatedData['last_name'] ?? $user->surname;
                $user->email = $validatedData['email'];
                if (! empty($validatedData['phone'])) {
                    $user->phone = $validatedData['phone'];
                }
                $user->save();
            }
        }

        return redirect()->back()->with('success', 'Saved.');
    }

    public function destroy(Request $request, $id)
    {
        if (! auth()->user()?->hasStaffPermission('clients.delete')) {
            abort(403);
        }

        $selectedIdsJson = $request->input('selected_ids');
        if (! empty($selectedIdsJson)) {
            $ids = json_decode($selectedIdsJson, true);
            if (! is_array($ids)) {
                $ids = [$ids];
            }
        } else {
            $ids = [$id];
        }

        if (empty($ids)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Nothing selected.'], 400);
            }

            return redirect()->route('dashboard.clients')->with('error', 'Nothing selected.');
        }

        $deleted = DB::table('clients')->whereIn('id', $ids)->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Deleted.',
                'deleted_count' => $deleted,
            ]);
        }

        $message = count($ids) === 1
            ? 'Record deleted.'
            : count($ids).' records deleted.';

        return redirect()->route('dashboard.clients')->with('success', $message);
    }

    public function brandNewClients()
    {
        $oneDayAgo = Carbon::now()->subDay();

        return Client::where('created_at', '>=', $oneDayAgo)->get();
    }
}
