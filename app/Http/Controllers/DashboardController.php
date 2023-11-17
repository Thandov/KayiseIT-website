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
use App\Models\Gallery;
use App\Models\Photos;
use App\Models\GroupPhotos;
use Illuminate\Http\QuotationRequest;

class DashboardController extends Controller
{
    //
    
    public function index()
    {
        dd("£24324");  
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

        return view('home', compact('services', 'testimonials', 'blog', 'galleries'));
    }
}