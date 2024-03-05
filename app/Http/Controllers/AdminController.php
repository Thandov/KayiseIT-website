<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\SubService;
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




class AdminController extends Controller
{
    private $subServicesService;

    public function __construct(SubServicesService $subServicesService)
    {
        $this->subServicesService = $subServicesService;
    }
    public function index()
    {
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

        return view('admin.admin_dashboard', compact('users', 'employees', 'blogs', 'carousels', 'occupations', 'applications', 'internships', 'galleries', 'clients', 'services', 'quotations', 'invoices', 'newClients', 'urlSegments'));
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
        $quotations = Quotation::all();
        return view('admin.quotations', compact('quotations'));
    }

    public function invoices()
    {
        $invoices = Invoice::all();
        return view('admin.invoices', compact('invoices'));
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


        return view('/admin/clients', compact('clients'));
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

    public function viewinternship($id)
    {
        $internships = DB::table('internship_applications')->find($id);
        return view('admin/internships/viewinternship', compact('internships'),);
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
        return view('admin/services', compact('services'));
    }

    public function viewservice($slug)
    {
        echo "admin/services/viewservice";
        $service = Service::where('slug', $slug)->first();
        $subservices = SubService::where('service_id', $service->service_id)->get();

        $extras = (count($subservices) === 0) ? $extras = false : $extras = true;
        return view('admin/services/viewservice', compact('service', 'subservices', 'extras'));
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
    public function view_employee($name)
    {
        $id = DB::table('employees')->select('user_id')->where('first_name', $name)->first();
        $id = $id->user_id;
        $employee = DB::table('employees')->where('user_id', $id)->first();
        return view('admin/staff/viewstaff', compact('employee'));
    }

    public function all_employees()
    {
        $employees = DB::table('employees')->get();

        return view('/admin/staff', compact('employees'));
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
                    $profilePicture->storeAs('/images/employees', $profilePictureName);
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

            // Optionally, you can also display a success message
            return redirect()->route('dashboard.staff.viewstaff', ['staffName' => $employee->first_name])->with('success', 'Employee created successfully!');
            //return back()->with('success', 'Employee created successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function delete_employee(Request $request, $id)
    {
        $id = (int)$id;
        $employee = DB::table('employees')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $employee->user_id)->first();

        if ($employee && $user) {
            // Perform your desired operations with the $employee and $user models

            // Delete the employee
            DB::table('employees')->where('id', $id)->delete();

            // Delete the associated user
            DB::table('users')->where('id', $employee->user_id)->delete();

            if ($request->ajax()) {
                return response()->json(['message' => 'Employee and associated user have been deleted.']);
            }

            return redirect()->route('admin.staff')->with('success', 'Employee and associated user have been deleted.');
        } else {
            if ($request->ajax()) {
                return response()->json(['message' => 'Employee or associated user not found.'], 404);
            }

            return redirect()->route('admin.staff')->with('error', 'Employee or associated user not found.');
        }
    }
    public function update_employee(Request $request)
    {

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

        $employee = Employee::where('user_id', $request->user_id)->first();
        $changedFields = [];


        if ($employee->first_name !== $validatedData['first_name']) {
            $employee->first_name = $validatedData['first_name'];
            $changedFields[] = 'first_name';
        }

        if ($employee->last_name !== $validatedData['last_name']) {
            $employee->last_name = $validatedData['last_name'];
            $changedFields[] = 'last_name';
        }

        if ($employee->email !== $validatedData['email']) {
            $employee->email = $validatedData['email'];
            $changedFields[] = 'email';
        }

        if ($employee->phone !== $validatedData['phone']) {
            $employee->phone = $validatedData['phone'];
            $changedFields[] = 'phone';
        }

        if ($employee->address !== $validatedData['address']) {
            $employee->address = $validatedData['address'];
            $changedFields[] = 'address';
        }

        if ($employee->province !== $validatedData['province']) {
            $employee->province = $validatedData['province'];
            $changedFields[] = 'province';
        }

        if ($employee->ID_number !== $validatedData['ID_number']) {
            $employee->ID_number = $validatedData['ID_number'];
            $changedFields[] = 'ID_number';
        }

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
                $profilePicture->storeAs('/images/employees', $profilePictureName);
                $employee->profile_picture = $profilePicturePath;
                $changedFields[] = 'profile_picture';
            } else {
                throw ValidationException::withMessages([
                    'profile_picture' => 'The profile picture is not valid.',
                ]);
            }
        }

        $employee->id_verifi_doc = $validatedData['id_verifi_doc'] ?? false;
        $employee->proof_address_verifi_doc = $validatedData['proof_address_verifi_doc'] ?? false;
        $employee->bank_confi_verifi = $validatedData['bank_confi_verifi'] ?? false;

        if ($employee->date_of_birth !== $validatedData['date_of_birth']) {
            $employee->date_of_birth = $validatedData['date_of_birth'];
            $changedFields[] = 'date_of_birth';
        }

        if (!empty($changedFields)) {
            $employee->save();
        }

        return view('admin.staff.viewstaff', compact('employee'))->with('success', 'Employee updated successfully.')->with('first_name', $employee->first_name);
    }
}
