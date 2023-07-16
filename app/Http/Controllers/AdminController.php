<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\client;
use App\Models\SubService;
use App\Models\Options;
use App\Models\Items;
use App\Models\Invoice;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    public function index()
    {
        $services = Service::paginate(5); // Paginate with 10 items per page
        $quotations = Quotation::all();
        $invoices = Invoice::all();
        $users = User::all();

        return view('admin.admin_dashboard', compact('users', 'services', 'quotations', 'invoices'));
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

    public function viewservice($id)
    {
        $service = Service::find($id);
        $subservices = SubService::where('service_id', $service->service_id)->get();
        return view('admin/viewservice', compact('service', 'subservices'));
    }

    public function viewsubservice($id)
    {
        $subservice = SubService::find($id);
        $options = Options::where('unq_id', $subservice->subserv_id)->get();
        return view('admin/viewsubservice', compact('subservice', 'options'));
    }
    public function view_employee($id)
    {
        $employee = DB::table('employees')->where('user_id', (int)$id)->first();
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
            return redirect()->route('admin.staff.viewstaff', ['id' => $employee->user_id]);
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

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
            $employee->profile_picture = $profilePicturePath;
            $changedFields[] = 'profile_picture';
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

        return redirect()->back()->with('success', 'Employee updated successfully.');
    }

    /* Clients */
    public function all_clients()
    {
        $employees = Client::all();

        return view('/admin/staff', compact('employees'));
    }
}