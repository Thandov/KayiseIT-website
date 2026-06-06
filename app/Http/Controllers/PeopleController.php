<?php

namespace App\Http\Controllers;

use App\Models\InternshipProgram;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeopleController extends Controller
{
    public function index()
    {
        $people = Person::with('program')->orderByDesc('created_at')->paginate(15);

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

        Person::create($validated);

        return redirect()->route('dashboard.people')->with('success', 'Person registered successfully.');
    }

    public function show(Person $person)
    {
        $person->load('program');

        return view('admin.dashboard.people.show', compact('person'));
    }

    public function edit(Person $person)
    {
        $programs = $this->enquiryPrograms();

        return view('admin.dashboard.people.edit', compact('person', 'programs'));
    }

    public function update(Request $request, Person $person)
    {
        $person->update($this->validatePerson($request, $person));

        return redirect()->route('dashboard.people.view', $person)->with('success', 'Person updated successfully.');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('dashboard.people')->with('success', 'Person deleted successfully.');
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

        Person::create($validated);

        return back()->with('success', 'Thank you! Your registration has been submitted successfully. Our team will be in touch.');
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

        $rules = [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'id_number' => 'required|string|max:50',
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
