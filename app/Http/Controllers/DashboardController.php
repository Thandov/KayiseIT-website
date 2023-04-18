<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\User;
use App\Models\Quotation;
use App\Models\Invoice;
use Illuminate\Http\QuotationRequest;

class DashboardController extends Controller
{
    //
    
    public function index()
    {
        if(Auth::user()->hasRole('client')){
            
            $services = Service::all();
            $testimonials = Testimonial::all();
            $blog = Blog::all();
            return redirect()->route('home', compact('services', 'testimonials', 'blog'));
        }
        else if(Auth::user()->hasRole('business')){

            $services = Service::all();
            $testimonials = Testimonial::all();
            $blog = Blog::all();
            return redirect()->route('home', compact('services', 'testimonials', 'blog'));

        }
        else if(Auth::user()->hasRole('admin')){

            $services = Service::all();
            $testimonials = Testimonial::all();
            $blog = Blog::all();
            $quotations = Quotation::all();
            $invoices = Invoice::all();
            $users = User::all();
            return view('admin.admin_dashboard', compact('services', 'testimonials', 'blog', 'quotations', 'invoices', 'users'));
        } 
    }

    public function home()
    {
        $services = Service::all();
        $testimonials = Testimonial::all();
        $blog = Blog::all();
        return view('home', compact('services', 'testimonials', 'blog'));
    }
}