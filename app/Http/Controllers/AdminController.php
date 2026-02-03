<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\Options;
use App\Models\Items;
use App\Models\Invoice;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use App\Services\SubServicesService;
use App\Helpers\getNewClientsHelper;
use App\Models\Gallery;
use App\Models\Photos;
use App\Models\GroupPhotos;
use App\Models\Occupations;
use App\Models\Specializations;
use App\Models\CareerSteps;
use App\Models\Carousel;
use App\Models\Blog;
use App\Models\Application;
use App\Models\InternshipApplication;
use App\Models\InternshipProgram;
use App\Models\InternsLearner;
use App\Models\MictBeneficiary;
use App\Models\Partner;




class AdminController extends Controller
{
    private $subServicesService;

    public function __construct(SubServicesService $subServicesService)
    {
        $this->subServicesService = $subServicesService;
    }
    public function index()
    {
        $user = auth()->user();
        if ($user && $user->hasRole('student')) {
            return redirect()->route('student.portal');
        }

        $clients = DB::table('clients')
            ->join('users', 'users.id', '=', 'clients.user_id')
            ->select('clients.name AS first_name', 'users.email', 'clients.*')
            ->get();
        $services = Service::paginate(5)->setPageName('servicePage');
        $quotations = Quotation::paginate(5)->setPageName('quotationPage');
        $invoices = Invoice::paginate(5)->setPageName('invoicePage');
        $users = User::paginate(5);
        $urlSegments = explode('/', request()->path());
        $newClients = getNewClients();

        /* Employees */
        $employees = Employee::paginate(5)->setPageName('carouselPage');
        /* Blogs */
        $blogs = Blog::paginate(5);
        /* Carousel */
        //$carousels = Carousel::paginate(5);
        $carousels = Carousel::paginate(2)->setPageName('carouselPage');

        // Check if the request is AJAX
        /*         if (request()->ajax()) {
            return response()->json([
                'html' => view('admin.dashboard.carousel._partial', compact('carousels'))->render(),
                'pagination' => (string) $carousels->links()
            ]);
        } */

        /* Occupations */
        $occupations = Occupations::all();
        $applications = Application::all();
        $internships = InternshipApplication::all();
        /* Gallery */
        $groups = Gallery::all();
        $galleries = [];
        foreach ($groups as $group) {
            $group_photo_ids = GroupPhotos::where('group_id', $group->id)->get();
            // Prepare an array to hold photo data for the current group
            $photoData = [];
            foreach ($group_photo_ids as $group_photo_id) {
                // For each group photo, fetch the actual photo
                $pic = Photos::where('id', $group_photo_id->photo_id)->first(); // Use first() if you expect a single photo
                if ($pic) {
                    // If a photo is found, add it to the photo data array
                    $photoData[] = $pic; // You might want to use just the path or a specific attribute
                }
            }
            if (!empty($photoData)) {
                // If photo data is not empty, add it to the galleries array with its corresponding group ID
                $galleries[] = [
                    'gallery_id' => $group->id,
                    'name' => $group->name,
                    'photos' => $photoData
                ];
            }
        }

        return view('admin.dashboard.overview', compact('users', 'employees', 'blogs', 'carousels', 'occupations', 'applications', 'internships', 'galleries', 'clients', 'services', 'quotations', 'invoices', 'newClients', 'urlSegments'));
    }

    public function remove($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();
        return redirect()->back()->with('success', 'User has been deleted!');
    }

    public function removeinvoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return redirect()->back()->with('success', 'invoice has been deleted!');
    }

    public function quotations()
    {
        $quotations = Quotation::paginate(10);
        return view('admin.dashboard.quotations.index', compact('quotations'));
    }

    public function invoices()
    {
        $invoices = Invoice::paginate(10);
        return view('admin.dashboard.invoices.index', compact('invoices'));
    }

    public function view_all_blogs()
    {
        return view('admin.blogs.view_all_blogs');
    }

    public function clients()
    {
        $clients = User::select('users.*', 'roles.display_name')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.id', '!=', 1)
            ->get();

        return view('admin.dashboard.clients.index', compact('clients'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }



    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User has been deleted!');
    }

    public function viewapplications($id)
    {
        $applications = DB::table('applications')->find($id);
        return view('admin/applications/viewapplications', compact('applications'),);
    }


    public function viewInternship($id)
    {
        $internship = InternshipApplication::findOrFail($id);
        
        // Return JSON for modal
        return response()->json([
            'success' => true,
            'internship' => $internship
        ]);
    }

    public function downloadinternshipDocs($id, $type)
    {
        $application = InternshipApplication::findOrFail($id);
        $filePath = $type === 'cv' ? $application->cv_path : ($type === 'id_copy' ? $application->id_copy_path : $application->qualification_copy_path);

        return response()->download(public_path("{$filePath}"));
    }

    public function viewquotations($id)
    {
        $quotation = DB::table('quotations')->find($id);
        $items = Items::where('QI_id', $quotation->quotation_no)->get();
        return view('admin/viewquotations', compact('quotation', 'items'),);
    }

    public function viewinvoice($id)
    {
        $invoice = DB::table('invoices')->find($id);
        $items = Items::where('QI_id', $invoice->invoice_no)->get();
        return view('admin/viewinvoice', compact('invoice', 'items'));
    }

    public function viewuser($id)
    {
        $user = User::find($id);
        return view('admin/viewuser', compact('user'));
    }

    public function services()
    {
        $services = Service::all();
        return view('admin.dashboard.services.index', compact('services'));
    }

    /**
     * View a specific service and its subservices
     *
     * @param  string|int $slug
     * @return \Illuminate\View\View
     */
    public function viewservice($slug)
    {
        // Try to find by slug first, then by id
        $service = Service::where('slug', $slug)->first();
        
        if (!$service && is_numeric($slug)) {
            $service = Service::find($slug);
        }

        if (!$service) {
            return redirect()->back()->withErrors(['error' => 'Service not found.']);
        }
        $subservices = Subservice::where('service_id', $service->service_id)->get();
        $extras = $subservices->isNotEmpty();


        return view('admin.services.viewservice', compact('service', 'subservices', 'extras'));
    }

    public function viewsubservice($id)
    {
        $subservice = SubService::where('id', $id)->first();
        $options = Options::where('subservice_id', $subservice->subserv_id)->get();
        $serviceName = $this->subServicesService->findService($subservice->service_id)->name;
        $serviceDesc = $this->subServicesService->findService($subservice->service_id)->description;
        $serviceID = $this->subServicesService->findService($subservice->service_id)->id;

        return view('admin/subservices/viewsubservice', compact('id', 'subservice', 'options', 'serviceName', 'serviceID', 'serviceDesc'));
    }
    public function view_employee($id)
    {
        // Try to find by ID first, then by first_name
        $employee = Employee::where('id', $id)->orWhere('first_name', $id)->first();
        
        if (!$employee) {
            return redirect()->route('admin.dashboard.staff')->with('error', 'Staff member not found.');
        }
        
        return view('admin.dashboard.staff.view', compact('employee'));
    }

    public function all_employees()
    {
        $employees = Employee::paginate(10);

        return view('admin.dashboard.staff.index', compact('employees'));
    }

    public function all_JSON_employees()
    {
        // Retrieve all employees using your desired logic
        $employees = DB::table('employees')->get();

        return $employees;
    }

    public function new_employee(Request $request)
    {
        try {
            // Validate the form data
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'ID_number' => 'required|string|min:13|max:13|unique:employees,ID_number',
                //'profile_picture' => 'nullable|image|max:2048',
                //'id_verifi_doc' => 'nullable|boolean',
                //'proof_address_verifi_doc' => 'nullable|boolean',
                //'bank_confi_verifi' => 'nullable|boolean',
                'date_of_birth' => 'nullable|date',
            ]);

            // Handle profile picture upload
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture');

                if ($profilePicture->isValid()) {
                    $firstName = strtolower($validatedData['first_name']);
                    $lastName = strtolower($validatedData['last_name']);
                    $id = strtolower($validatedData['ID_number']);

                    $extension = $profilePicture->getClientOriginalExtension();
                    $profilePictureName = $firstName . '_' . $lastName . '_' . $id . '.' . $extension;

                    $profilePicturePath = 'images/employees/' . $profilePictureName;
                    $profilePicture->storeAs('public/images/employees', $profilePictureName);
                } else {
                    throw ValidationException::withMessages([
                        'profile_picture' => 'The profile picture is not valid.',
                    ]);
                }
            }

            $user = new User;
            $user->name = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt('K@y1s31T'); // Set the temporary password
            $user->save();

            // Create a new employee record
            $employee = new Employee;
            $employee->user_id = $user->id;
            $employee->first_name = $validatedData['first_name'];
            $employee->last_name = $validatedData['last_name'];
            $employee->email = $validatedData['email'];
            $employee->phone = $validatedData['phone'];
            $employee->address = $validatedData['address'];
            $employee->province = $validatedData['province'];
            $employee->ID_number = $validatedData['ID_number'];
            $employee->profile_picture = $profilePicturePath;
            $employee->id_verifi_doc = $validatedData['id_verifi_doc'] ?? false;
            $employee->proof_address_verifi_doc = $validatedData['proof_address_verifi_doc'] ?? false;
            $employee->bank_confi_verifi = $validatedData['bank_confi_verifi'] ?? false;
            $employee->date_of_birth = $validatedData['date_of_birth'];
            $employee->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Staff member created successfully.', 'employee' => $employee]);
            }
            
            return redirect()->route('admin.dashboard.staff')->with('success', 'Staff member created successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function delete_employee(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            
            if ($employee->user_id) {
                $user = User::find($employee->user_id);
                if ($user) {
                    $user->delete();
                }
            }
            
            // Delete profile picture if exists
            if ($employee->profile_picture && Storage::exists('public/' . $employee->profile_picture)) {
                Storage::delete('public/' . $employee->profile_picture);
            }
            
            $employee->delete();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Staff member and associated user have been deleted.']);
            }

            return redirect()->route('admin.dashboard.staff')->with('success', 'Staff member and associated user have been deleted.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to delete staff member: ' . $e->getMessage()], 500);
            }

            return redirect()->route('admin.dashboard.staff')->with('error', 'Failed to delete staff member: ' . $e->getMessage());
        }
    }
    public function update_employee(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
                'ID_number' => 'required|string|min:13|max:13|unique:employees,ID_number,' . $employee->id,
                'date_of_birth' => 'nullable|date',
                'profile_picture' => 'nullable|image|max:2048',
                'id_verifi_doc' => 'nullable|boolean',
                'proof_address_verifi_doc' => 'nullable|boolean',
                'bank_confi_verifi' => 'nullable|boolean',
            ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');

            if ($profilePicture->isValid()) {
                    // Delete old profile picture if exists
                    if ($employee->profile_picture && Storage::exists('public/' . $employee->profile_picture)) {
                        Storage::delete('public/' . $employee->profile_picture);
                    }
                    
                $firstName = strtolower($validatedData['first_name']);
                $lastName = strtolower($validatedData['last_name']);
                    $idNumber = strtolower($validatedData['ID_number']);

                $extension = $profilePicture->getClientOriginalExtension();
                    $profilePictureName = $firstName . '_' . $lastName . '_' . $idNumber . '.' . $extension;

                $profilePicturePath = 'images/employees/' . $profilePictureName;
                    $profilePicture->storeAs('public/images/employees', $profilePictureName);
                    $validatedData['profile_picture'] = $profilePicturePath;
                }
            }

            // Update employee
            $employee->update($validatedData);
            
            // Update associated user if exists
            if ($employee->user_id) {
                $user = User::find($employee->user_id);
                if ($user) {
                    $user->name = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
                    $user->email = $validatedData['email'];
                    $user->save();
                }
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Staff member updated successfully.', 'employee' => $employee]);
            }

            return redirect()->route('admin.dashboard.staff')->with('success', 'Staff member updated successfully.');
        } catch (ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to update staff member: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to update staff member: ' . $e->getMessage())->withInput();
        }
    }

    // Applications CRUD methods
    public function applications()
    {
        $applications = Application::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.applications.index', compact('applications'));
    }

    public function createApplication()
    {
        return view('admin.applications.create');
    }

    public function storeApplication(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        Application::create($validatedData);
        return redirect()->route('dashboard.applications')->with('success', 'Application created successfully.');
    }

    public function editApplication($id)
    {
        $application = Application::findOrFail($id);
        return view('admin.applications.edit', compact('application'));
    }

    public function updateApplication(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $application->update($validatedData);
        return redirect()->route('dashboard.applications')->with('success', 'Application updated successfully.');
    }

    public function deleteApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();
        return redirect()->back()->with('success', 'Application deleted successfully.');
    }

    public function deleteSelectedApplications(Request $request)
    {
        $selectedIds = json_decode($request->input('selected_ids'));
        Application::whereIn('id', $selectedIds)->delete();
        return redirect()->back()->with('success', 'Selected applications deleted successfully.');
    }

    // Internships CRUD methods
    public function internships()
    {
        $internships = InternshipApplication::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.internships.index', compact('internships'));
    }

    public function createInternship()
    {
        return view('admin.internships.create');
    }

    public function storeInternship(Request $request)
    {
        try {
            // Generate a unique app_id
            $app_id = 'APP_' . mt_rand(100000, 999999);
            
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'id_no' => 'required|string|max:20',
                'age' => 'required|string|max:3',
                'address' => 'required|string|max:500',
                'high_school' => 'required|string|max:255',
                'year_of_completion' => 'required|string|max:4',
                'qualification' => 'required|string|max:255',
                'year_obtained' => 'required|string|max:4',
                'institution' => 'required|string|max:255',
                'app_type' => 'required|string|max:50',
                'field' => 'required|string|max:100',
                'status' => 'required|string|in:pending,approved,rejected',
                'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'id_copy_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'qualification_copy_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            // Handle file uploads
            $documentPaths = [
                'cv_path' => null,
                'id_copy_path' => null,
                'qualification_copy_path' => null
            ];

            // Upload CV
            if ($request->hasFile('cv_file')) {
                $cvPath = $request->file('cv_file')->store('internships/documents', 'public');
                $documentPaths['cv_path'] = $cvPath;
            }

            // Upload ID Copy
            if ($request->hasFile('id_copy_file')) {
                $idCopyPath = $request->file('id_copy_file')->store('internships/documents', 'public');
                $documentPaths['id_copy_path'] = $idCopyPath;
            }

            // Upload Qualification Copy
            if ($request->hasFile('qualification_copy_file')) {
                $qualificationCopyPath = $request->file('qualification_copy_file')->store('internships/documents', 'public');
                $documentPaths['qualification_copy_path'] = $qualificationCopyPath;
            }

            // Prepare data for insertion
            $internshipData = array_merge([
                'app_id' => $app_id,
                'user_id' => auth()->id(),
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'id_no' => $validatedData['id_no'],
                'age' => $validatedData['age'],
                'address' => $validatedData['address'],
                'high_school' => $validatedData['high_school'],
                'year_of_completion' => $validatedData['year_of_completion'],
                'qualification' => $validatedData['qualification'],
                'year_obtained' => $validatedData['year_obtained'],
                'institution' => $validatedData['institution'],
                'app_type' => $validatedData['app_type'],
                'field' => $validatedData['field'],
                'status' => $validatedData['status'],
            ], $documentPaths);

            InternshipApplication::create($internshipData);
            
            return response()->json([
                'success' => true,
                'message' => 'Internship application created successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating internship: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Manually add internship to the database - for direct database insertion
     * Usage: Call this method or use the examples given below
     */
    public function addInternshipManually()
    {
        // Example 1: Create a new internship application
        $internship = new InternshipApplication();
        $internship->app_id = 'APP_' . mt_rand(100000, 999999);
        $internship->user_id = 1; // Replace with actual user ID
        $internship->id_no = '9901234567890';
        $internship->age = '25';
        $internship->address = '123 Main Street, Cape Town';
        $internship->high_school = 'Springfield High School';
        $internship->year_of_completion = '2017';
        $internship->qualification = 'Bachelor Computer Science';
        $internship->year_obtained = '2021';
        $internship->institution = 'University of Cape Town';
        $internship->app_type = 'Full Time';
        $internship->field = 'Software Development';
        $internship->cv_path = 'documents/cv_sample.pdf';
        $internship->id_copy_path = 'documents/id_copy_sample.pdf';
        $internship->qualification_copy_path = 'documents/certificate_sample.pdf';
        $internship->save();

        return "Internship application created successfully!";
    }

    public function editInternship($id)
    {
        $internship = InternshipApplication::findOrFail($id);
        return view('admin.internships.edit', compact('internship'));
    }

    public function updateInternship(Request $request, $id)
    {
        try {
            $internship = InternshipApplication::findOrFail($id);
            
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'id_no' => 'required|string|max:20',
                'age' => 'required|string|max:3',
                'address' => 'required|string|max:500',
                'high_school' => 'required|string|max:255',
                'year_of_completion' => 'required|string|max:4',
                'qualification' => 'required|string|max:255',
                'year_obtained' => 'required|string|max:4',
                'institution' => 'required|string|max:255',
                'app_type' => 'required|string|max:50',
                'field' => 'required|string|max:100',
                'status' => 'required|string|in:pending,approved,rejected',
                'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'id_copy_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'qualification_copy_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            // Handle file uploads (only update if new files are uploaded)
            $documentPaths = [];

            // Upload CV if provided
            if ($request->hasFile('cv_file')) {
                $cvPath = $request->file('cv_file')->store('internships/documents', 'public');
                $documentPaths['cv_path'] = $cvPath;
            }

            // Upload ID Copy if provided
            if ($request->hasFile('id_copy_file')) {
                $idCopyPath = $request->file('id_copy_file')->store('internships/documents', 'public');
                $documentPaths['id_copy_path'] = $idCopyPath;
            }

            // Upload Qualification Copy if provided
            if ($request->hasFile('qualification_copy_file')) {
                $qualificationCopyPath = $request->file('qualification_copy_file')->store('internships/documents', 'public');
                $documentPaths['qualification_copy_path'] = $qualificationCopyPath;
            }

            // Prepare data for update
            $updateData = array_merge([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'id_no' => $validatedData['id_no'],
                'age' => $validatedData['age'],
                'address' => $validatedData['address'],
                'high_school' => $validatedData['high_school'],
                'year_of_completion' => $validatedData['year_of_completion'],
                'qualification' => $validatedData['qualification'],
                'year_obtained' => $validatedData['year_obtained'],
                'institution' => $validatedData['institution'],
                'app_type' => $validatedData['app_type'],
                'field' => $validatedData['field'],
                'status' => $validatedData['status'],
            ], $documentPaths);

            $internship->update($updateData);
            
            return response()->json([
                'success' => true,
                'message' => 'Internship application updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating internship: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteInternship($id)
    {
        $internship = InternshipApplication::findOrFail($id);
        $internship->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Internship application deleted successfully.'
        ]);
    }

    public function deleteSelectedInternships(Request $request)
    {
        try {
            $selectedIds = $request->input('selected_ids');
            if (is_string($selectedIds)) {
                $selectedIds = json_decode($selectedIds);
            }
            
            InternshipApplication::whereIn('id', $selectedIds)->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Selected internship applications deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting internships: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteSelectedServices(Request $request)
    {
        try {
            $selectedIds = json_decode($request->input('selected_ids'));
            
            if (empty($selectedIds)) {
                return redirect()->back()->with('warning', 'No services selected for deletion.');
            }
            
            $count = Service::whereIn('id', $selectedIds)->count();
            Service::whereIn('id', $selectedIds)->delete();
            
            return redirect()->route('dashboard.services')
                ->with('success', $count . ' service(s) deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.services')
                ->with('error', 'Failed to delete services: ' . $e->getMessage());
        }
    }

    // ==================== INTERNS & LEARNERS CRUD ====================

    public function internsLearners()
    {
        try {
            $internsLearners = InternsLearner::with(['program', 'internshipApplication'])->orderBy('created_at', 'desc')->paginate(10);
        } catch (\Exception $e) {
            // If table doesn't exist, create empty collection
            $internsLearners = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        }
        $programs = InternshipProgram::all();
        return view('admin.dashboard.interns-learners.index', compact('internsLearners', 'programs'));
    }

    public function createInternLearner()
    {
        $programs = InternshipProgram::all();
        try {
            $applications = InternshipApplication::whereDoesntHave('internLearner')->get();
        } catch (\Exception $e) {
            // If table doesn't exist yet, just get all applications
            $applications = InternshipApplication::all();
        }
        return view('admin.dashboard.interns-learners.create', compact('programs', 'applications'));
    }

    public function storeInternLearner(Request $request)
    {
        $validatedData = $request->validate([
            'internship_application_id' => 'nullable|exists:internship_applications,id',
            'program_id' => 'nullable|exists:internship_programs,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'id_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,completed,terminated',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        InternsLearner::create($validatedData);

        return redirect()->route('dashboard.interns-learners')->with('success', 'Intern/Learner created successfully.');
    }

    public function viewInternLearner($id)
    {
        // mict_beneficiary is a computed attribute, so we only eager load real relationships
        $internLearner = InternsLearner::with(['program', 'internshipApplication'])->findOrFail($id);
        return view('admin.dashboard.interns-learners.view', compact('internLearner'));
    }

    public function editInternLearner($id)
    {
        $internLearner = InternsLearner::findOrFail($id);
        $programs = InternshipProgram::all();
        try {
            $applications = InternshipApplication::whereDoesntHave('internLearner')->orWhere('id', $internLearner->internship_application_id)->get();
        } catch (\Exception $e) {
            // If table doesn't exist yet, just get all applications
            $applications = InternshipApplication::all();
        }
        
        // Load MICT beneficiary if exists
        $mictBeneficiary = null;
        if ($internLearner->program_id && $internLearner->email) {
            $mictBeneficiary = MictBeneficiary::where('email_address', $internLearner->email)
                                              ->where('program_id', $internLearner->program_id)
                                              ->first();
        }
        
        return view('admin.dashboard.interns-learners.edit', compact('internLearner', 'programs', 'applications', 'mictBeneficiary'));
    }

    public function updateInternLearner(Request $request, $id)
    {
        $internLearner = InternsLearner::findOrFail($id);

        $validatedData = $request->validate([
            'internship_application_id' => 'nullable|exists:internship_applications,id',
            'program_id' => 'nullable|exists:internship_programs,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'id_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,completed,terminated',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        $internLearner->update($validatedData);

        // Update MICT beneficiary if exists and MICT data is provided
        if ($request->has('mict_beneficiary_id') && $request->mict_beneficiary_id) {
            $mictBeneficiary = MictBeneficiary::findOrFail($request->mict_beneficiary_id);
            
            // Validate and update MICT beneficiary fields
            $mictData = $request->validate([
                // Learner Details
                'learner_title' => 'nullable|string|max:20',
                'maiden_name' => 'nullable|string|max:255',
                'type_of_id' => 'nullable|string|max:50',
                'residence_status' => 'nullable|string|max:50',
                'marital_status' => 'nullable|string|max:50',
                'race' => 'nullable|string|max:50',
                'disabled' => 'nullable|boolean',
                'type_of_disability' => 'nullable|string|max:255',
                'age' => 'nullable|integer',
                'sa_citizen' => 'nullable|boolean',
                'nationality' => 'nullable|string|max:100',
                'first_language' => 'nullable|string|max:100',
                'employed' => 'nullable|boolean',
                'length_of_unemployment_years' => 'nullable|integer',
                'employment_start_date' => 'nullable|date',
                'learner_agreement_start_date' => 'nullable|date',
                'learner_agreement_end_date' => 'nullable|date',
                'program_start_date' => 'nullable|date',
                'amount_allocated' => 'nullable|numeric',
                'previous_internship' => 'nullable|boolean',
                'year_of_study' => 'nullable|string|max:50',
                // Address
                'physical_address_1' => 'nullable|string|max:255',
                'physical_address_2' => 'nullable|string|max:255',
                'physical_address_3' => 'nullable|string|max:255',
                'physical_postal_code' => 'nullable|string|max:20',
                'postal_address_1' => 'nullable|string|max:255',
                'postal_address_2' => 'nullable|string|max:255',
                'postal_address_3' => 'nullable|string|max:255',
                'postal_address_postal_code' => 'nullable|string|max:20',
                'type_of_area' => 'nullable|string|max:50',
                'cellphone' => 'nullable|string|max:20',
                'telephone' => 'nullable|string|max:20',
                'fax' => 'nullable|string|max:20',
                // Qualification
                'highest_nqf_qualification' => 'nullable|string|max:50',
                'other_qualification' => 'nullable|string|max:255',
                'title_of_highest_qualification' => 'nullable|string|max:255',
                'has_matriculated' => 'nullable|boolean',
                'matriculated_in_sa' => 'nullable|boolean',
                'province_of_high_school' => 'nullable|string|max:100',
                'year_of_national_senior_certificate' => 'nullable|string|max:10',
                // Guardian
                'guardian_first_name' => 'nullable|string|max:255',
                'guardian_last_name' => 'nullable|string|max:255',
                'guardian_type_of_id' => 'nullable|string|max:50',
                'guardian_id_number' => 'nullable|string|max:20',
                'guardian_telephone' => 'nullable|string|max:20',
                'guardian_cellphone' => 'nullable|string|max:20',
                'guardian_home_address' => 'nullable|string',
                'guardian_postal_address' => 'nullable|string',
                'guardian_email_address' => 'nullable|email|max:255',
            ]);
            
            $mictBeneficiary->update($mictData);
        }

        return redirect()->route('dashboard.interns-learners')->with('success', 'Intern/Learner updated successfully.');
    }

    public function deleteInternLearner($id)
    {
        $internLearner = InternsLearner::findOrFail($id);
        $internLearner->delete();
        
        return redirect()->route('dashboard.interns-learners')->with('success', 'Intern/Learner deleted successfully.');
    }

    public function deleteSelectedInternsLearners(Request $request)
    {
        $selectedIds = json_decode($request->input('selected_ids'));
        InternsLearner::whereIn('id', $selectedIds)->delete();
        
        return redirect()->back()->with('success', 'Selected interns/learners deleted successfully.');
    }

    // ==================== PROGRAMS CRUD ====================

    public function programs()
    {
        $programs = InternshipProgram::with('partner')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard.programs.index', compact('programs'));
    }

    public function createProgram()
    {
        $skillsDevPartners = Partner::where('partner_type', 'Skills Development')->where('is_active', true)->orderBy('name')->get();
        return view('admin.dashboard.programs.create', compact('skillsDevPartners'));
    }

    public function storeProgram(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'program_type' => 'required|string|in:Internship,TVET Placement,Short Program',
            'partner_id' => 'nullable|exists:partners,id',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'recruitment_start_date' => 'required|date',
            'recruitment_end_date' => 'required|date|after:recruitment_start_date',
            'number_needed' => 'required|integer|min:1',
            'has_stipend' => 'boolean',
            'stipend_amount' => 'nullable|numeric|min:0',
            'stipend_currency' => 'required_with:stipend_amount|string|max:3',
            'has_accreditation' => 'boolean',
            'accreditation_details' => 'nullable|string',
            'youth_beneficiaries' => 'boolean',
            'requirements' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $programData = [
            'name' => $validatedData['name'],
            'program_type' => $validatedData['program_type'],
            'partner_id' => $validatedData['partner_id'] ?? null,
            'description' => $validatedData['description'],
            'duration' => $validatedData['duration'],
            'recruitment_start_date' => $validatedData['recruitment_start_date'],
            'recruitment_end_date' => $validatedData['recruitment_end_date'],
            'number_needed' => $validatedData['number_needed'],
            'has_stipend' => $validatedData['has_stipend'] ?? false,
            'stipend_amount' => $validatedData['stipend_amount'],
            'stipend_currency' => $validatedData['stipend_currency'] ?? 'ZAR',
            'has_accreditation' => $validatedData['has_accreditation'] ?? false,
            'accreditation_details' => $validatedData['accreditation_details'],
            'youth_beneficiaries' => $validatedData['youth_beneficiaries'] ?? false,
            'requirements' => $validatedData['requirements'],
            'is_active' => $validatedData['is_active'] ?? true,
        ];

        InternshipProgram::create($programData);

        return redirect()->route('dashboard.programs')->with('success', 'Program created successfully.');
    }

    public function viewProgram($id)
    {
        $program = InternshipProgram::with('partner')->findOrFail($id);
        return view('admin.dashboard.programs.view', compact('program'));
    }

    public function editProgram($id)
    {
        $program = InternshipProgram::findOrFail($id);
        $skillsDevPartners = Partner::where('partner_type', 'Skills Development')->where('is_active', true)->orderBy('name')->get();
        return view('admin.dashboard.programs.edit', compact('program', 'skillsDevPartners'));
    }

    public function updateProgram(Request $request, $id)
    {
        $program = InternshipProgram::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'program_type' => 'required|string|in:Internship,TVET Placement,Short Program',
            'partner_id' => 'nullable|exists:partners,id',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'recruitment_start_date' => 'required|date',
            'recruitment_end_date' => 'required|date|after:recruitment_start_date',
            'number_needed' => 'required|integer|min:1',
            'has_stipend' => 'boolean',
            'stipend_amount' => 'nullable|numeric|min:0',
            'stipend_currency' => 'required_with:stipend_amount|string|max:3',
            'has_accreditation' => 'boolean',
            'accreditation_details' => 'nullable|string',
            'youth_beneficiaries' => 'boolean',
            'requirements' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $program->update($validatedData);

        return redirect()->route('dashboard.programs')->with('success', 'Program updated successfully.');
    }

    public function deleteProgram($id)
    {
        $program = InternshipProgram::findOrFail($id);
        $program->delete();
        
        return redirect()->route('dashboard.programs')->with('success', 'Program deleted successfully.');
    }

    public function deleteSelectedPrograms(Request $request)
    {
        $selectedIds = json_decode($request->input('selected_ids'));
        InternshipProgram::whereIn('id', $selectedIds)->delete();
        
        return redirect()->back()->with('success', 'Selected programs deleted successfully.');
    }

    // ==================== PARTNERS CRUD ====================

    public function partners()
    {
        $partners = Partner::ordered()->paginate(10);
        return view('admin.dashboard.partners.index', compact('partners'));
    }

    public function createPartner()
    {
        return view('admin.dashboard.partners.create');
    }

    public function storePartner(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'partner_type' => 'nullable|string|in:Skills Development,JV,Sponsor,Other',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $partnerData = [
            'name' => $validatedData['name'],
            'partner_type' => $validatedData['partner_type'] ?? null,
            'website_url' => $validatedData['website_url'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'display_order' => $validatedData['display_order'] ?? 0,
            'is_active' => $validatedData['is_active'] ?? true,
        ];

        // Handle logo upload - store directly in public/images/partners
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $extension = $file->getClientOriginalExtension();
            $safeName = \Illuminate\Support\Str::slug($validatedData['name'] ?: 'partner');
            $filename = $safeName . '.' . $extension;

            $destination = public_path('images/partners');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $partnerData['logo_path'] = 'images/partners/' . $filename;
        }

        Partner::create($partnerData);

        return redirect()->route('dashboard.partners')->with('success', 'Partner created successfully.');
    }

    public function viewPartner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.dashboard.partners.view', compact('partner'));
    }

    public function editPartner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.dashboard.partners.edit', compact('partner'));
    }

    public function updatePartner(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'partner_type' => 'nullable|string|in:Skills Development,JV,Sponsor,Other',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $partnerData = [
            'name' => $validatedData['name'],
            'partner_type' => $validatedData['partner_type'] ?? null,
            'website_url' => $validatedData['website_url'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'display_order' => $validatedData['display_order'] ?? 0,
            'is_active' => $validatedData['is_active'] ?? true,
        ];

        // Handle logo upload - store directly in public/images/partners
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            // Delete old logo if exists
            if ($partner->logo_path) {
                $oldPath = public_path($partner->logo_path);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $extension = $file->getClientOriginalExtension();
            $safeName = \Illuminate\Support\Str::slug($validatedData['name'] ?: $partner->name ?: 'partner');
            $filename = $safeName . '.' . $extension;

            $destination = public_path('images/partners');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $partnerData['logo_path'] = 'images/partners/' . $filename;
        }

        $partner->update($partnerData);

        return redirect()->route('dashboard.partners')->with('success', 'Partner updated successfully.');
    }

    public function deletePartner($id)
    {
        $partner = Partner::findOrFail($id);
        
        // Delete logo if exists
        if ($partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
        }
        
        $partner->delete();
        
        return redirect()->route('dashboard.partners')->with('success', 'Partner deleted successfully.');
    }

    public function deleteSelectedPartners(Request $request)
    {
        $selectedIds = json_decode($request->input('selected_ids'));
        
        foreach ($selectedIds as $id) {
            $partner = Partner::find($id);
            if ($partner) {
                // Delete logo if exists
                if ($partner->logo_path) {
                    Storage::disk('public')->delete($partner->logo_path);
                }
                $partner->delete();
            }
        }
        
        return redirect()->back()->with('success', 'Selected partners deleted successfully.');
    }
}
