<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Website;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $websites = Website::all();
        $users = User::all();
        return view('admin.admin_dashboard', compact('websites', 'users'));
    }

    public function remove($id){

        $websites = Website::find($id);
        $websites->delete();
        return view('admin/quotations')->with('status','Profile Deleted');
    }

    public function quotations()
    {
        $websites = Website::all();
        $users = User::all();
        return view('admin.quotations', compact('websites', 'users'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function removeuser($id){

        $users = User::find($id);
        $users->delete();
        return redirect('admin/users')->with('status','Profile Deleted');
    }

    public function viewwebquotes($id)
    {
        $website = Website::find($id);
        return view('admin/viewwebquotes', compact('website'));
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
        $subservices = SubServices::where('service_id', $id)->get();
        return view('admin/viewservice', compact('service', 'subservices'));
    }

    public function removeservice($id){

        $services = Service::find($id);
        $services->delete();
        return redirect('admin/services')->with('status','service Deleted');
    }
}
