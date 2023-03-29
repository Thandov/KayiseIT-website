<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Website;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Options;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $websites = Website::all();
        $users = User::all();
        return view('admin.admin_dashboard', compact('websites', 'users'));
    }

    public function remove($id){

        $quotation = Quotation::find($id);
        $quotation->delete();
        return redirect()->back()->with('success', 'User has been deleted!');
    }

    public function quotations()
    {
        $quotations = Quotation::all();
        return view('admin.quotations', compact('quotations'));
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
        return view('admin/viewquotations', compact('quotation', 'items'));
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
    
}
