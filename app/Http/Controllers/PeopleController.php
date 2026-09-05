<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationAccepted;
use App\Mail\ApplicationRejected;
use App\Mail\RegistrationConfirmation;
use App\Models\InternshipApplication;
use App\Models\InternshipProgram;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::with('program')->orderByDesc('created_at');

        if ($request->filled('type') && in_array($request->type, ['enquiry', 'application'], true)) {
            $query->where('record_type', $request->type);
        }

        $people = $query->paginate(15)->withQueryString();

        return view('admin.dashboard.people.index', compact('people'));
    }

    public function create()
    {
        $programs = $this->enquiryPrograms();

        return view('admin.dashboard.people.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePerson($request, null, false);
        $validated['source'] = 'admin';
        $validated['record_type'] = Person::TYPE_ENQUIRY;

        $person = Person::create($validated);
        $person->load('program');
        $this->backupToJson($person);

        return redirect()->route('dashboard.people')->with('success', 'Person registered successfully.');
    }

    public function show(Person $person)
    {
        $person->load('program', 'user');

        return view('admin.dashboard.people.show', compact('person'));
    }

    public function edit(Person $person)
    {
        if ($person->isApplication()) {
            return redirect()->route('dashboard.people.view', $person)
                ->with('error', 'Full applications are managed from the profile view. Use accept/reject actions on the detail page.');
        }

        $programs = $this->enquiryPrograms();

        return view('admin.dashboard.people.edit', compact('person', 'programs'));
    }

    public function update(Request $request, Person $person)
    {
        if ($person->isApplication()) {
            return redirect()->route('dashboard.people.view', $person)
                ->with('error', 'Application records cannot be edited from this form.');
        }

        $person->update($this->validatePerson($request, $person));

        return redirect()->route('dashboard.people.view', $person)->with('success', 'Person updated successfully.');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('dashboard.people')->with('success', 'Record deleted successfully.');
    }

    public function accept(Request $request, Person $person)
    {
        abort_unless($person->isApplication(), 404);

        $request->validate([
            'admin_message' => 'required|string|max:1000',
        ]);

        $person->status = 'accepted';
        $person->admin_message = $request->admin_message;
        $person->responded_by = auth()->id();
        $person->responded_at = now();
        $person->save();

        $application = InternshipApplication::findOrFail($person->id);
        Mail::to($person->email)->send(new ApplicationAccepted($application, $request->admin_message));

        return redirect()->back()->with('success', 'Application accepted and email sent to the applicant.');
    }

    public function reject(Request $request, Person $person)
    {
        abort_unless($person->isApplication(), 404);

        $request->validate([
            'admin_message' => 'required|string|max:1000',
        ]);

        $person->status = 'rejected';
        $person->admin_message = $request->admin_message;
        $person->responded_by = auth()->id();
        $person->responded_at = now();
        $person->save();

        $application = InternshipApplication::findOrFail($person->id);
        Mail::to($person->email)->send(new ApplicationRejected($application, $request->admin_message));

        return redirect()->back()->with('success', 'Application rejected and email sent to the applicant.');
    }

    public function downloadDocument(Person $person, string $type)
    {
        abort_unless($person->isApplication(), 404);

        $filePath = match ($type) {
            'cv' => $person->cv_path,
            'id_copy' => $person->id_copy_path,
            'qualification_copy' => $person->qualification_copy_path,
            'proof_of_payment' => $person->proof_of_payment_path,
            default => null,
        };

        abort_unless($filePath, 404);

        return response()->download(public_path($filePath));
    }

    public function publicIndex()
    {
        $enquiryPrograms = InternshipProgram::collectingEnquiries()->get();
        $runningPrograms = InternshipProgram::activelyRunning()->get();
        $programs = $enquiryPrograms;

        return view('programs', compact('enquiryPrograms', 'runningPrograms', 'programs'));
    }

    public function publicStore(Request $request)
    {
        $validated = $this->validatePerson($request, null, true);
        $validated['source'] = 'public';
        $validated['record_type'] = Person::TYPE_ENQUIRY;

        $person = Person::create($validated);
        $person->load('program');

        Log::channel('single')->info('REGISTRATION', [
            'id'         => $person->id,
            'name'       => $person->full_name,
            'id_number'  => $person->id_number,
            'email'      => $person->email,
            'cellphone'  => $person->cellphone,
            'programme'  => $person->program->name ?? 'N/A',
            'location'   => $person->location_name . ' (' . $person->location_type . '), ' . $person->province,
            'registered' => now()->toDateTimeString(),
        ]);

        $this->backupToJson($person);

        Mail::to($person->email)->send(new RegistrationConfirmation($person));

        return back()->with('success', 'Thank you! Your registration has been submitted successfully. Our team will be in touch.');
    }

    public static function resolveApplication(int|string $id): Person
    {
        $person = Person::applications()->find($id);

        if ($person) {
            return $person;
        }

        return Person::applications()
            ->where('legacy_application_id', $id)
            ->firstOrFail();
    }

    private function backupToJson(Person $person): void
    {
        $path = 'backups/applicants.json';

        $existing = Storage::exists($path)
            ? json_decode(Storage::get($path), true) ?? []
            : [];

        $existing[$person->id_number] = [
            'id'           => $person->id,
            'name'         => $person->name,
            'surname'      => $person->surname,
            'id_number'    => $person->id_number,
            'email'        => $person->email,
            'cellphone'    => $person->cellphone,
            'country'      => $person->country,
            'province'     => $person->province,
            'location_type'=> $person->location_type,
            'location_name'=> $person->location_name,
            'programme'    => $person->program->name ?? 'N/A',
            'source'       => $person->source,
            'registered_at'=> $person->created_at->toDateTimeString(),
            'backed_up_at' => now()->toDateTimeString(),
        ];

        Storage::put($path, json_encode(array_values($existing), JSON_PRETTY_PRINT));
    }

    private function enquiryPrograms()
    {
        return InternshipProgram::active()->orderBy('name')->get();
    }

    private function validatePerson(Request $request, ?Person $person = null, bool $public = false): array
    {
        $programRule = Rule::exists('internship_programs', 'id')->where(function ($query) use ($public) {
            $query->where('is_active', true);
            if ($public) {
                $query->where('allows_enquiry', true);
            }
        });

        $uniqueIdRule = Rule::unique('people', 'id_number');
        if ($person) {
            $uniqueIdRule->ignore($person->id);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'id_number' => ['required', 'string', 'max:50', $uniqueIdRule],
            'email' => 'required|email|max:255',
            'cellphone' => 'required|string|max:50',
            'country' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'location_type' => 'required|in:town,township',
            'location_name' => 'required|string|max:255',
            'internship_program_id' => ['required', 'integer', $programRule],
        ];

        return $request->validate($rules);
    }
}
