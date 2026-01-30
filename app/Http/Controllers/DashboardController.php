<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
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
use App\Models\Announcement;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Carousel;
use App\Helpers\ImagePathResolver;
use Illuminate\Http\QuotationRequest;

class DashboardController extends Controller
{
    //
    
    public function index()
    {
        $user = Auth::user();
        
        if($user && $user->hasRole('client')){
            $services = Service::all();
            $testimonials = Testimonial::all();
            $blog = Blog::all();
            return redirect()->route('home', compact('services', 'testimonials', 'blog'));
        }
        else if($user && $user->hasRole('business')){
            $services = Service::all();
            $testimonials = Testimonial::all();
            $blog = Blog::all();
            return redirect()->route('home', compact('services', 'testimonials', 'blog'));

        }
        else if($user && $user->hasRole('admin')){
            $services = Service::all();
            $testimonials = Testimonial::all();
            $blog = Blog::all();
            $quotations = Quotation::all();
            $invoices = Invoice::all();
            $users = User::all();
            $isAdmin = true;
            return view('admin.admin_dashboard', compact('services', 'testimonials', 'blog', 'quotations', 'invoices', 'users', 'isAdmin'));
        } 
    }

    public function home()
    {
        // Initialize all variables with defaults
        $services = collect();
        $testimonials = collect();
        $blog = collect();
        $galleries = [];
        $featuredGalleryPhotos = [];
        $announcements = collect();
        $partners = collect();
        $products = collect();
        $carouselSlides = collect();

        // Wrap each database query individually to handle connection errors gracefully
        try {
            $services = Service::all();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load services - '.$e->getMessage());
        }

        try {
            $testimonials = Testimonial::all();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load testimonials - '.$e->getMessage());
        }

        try {
            $blog = Blog::all();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load blog - '.$e->getMessage());
        }

        try {
            // Get featured gallery for homepage
            $featuredGallery = Gallery::where('featured_on_homepage', true)
                ->with('photos')
                ->first();
            
            if ($featuredGallery && $featuredGallery->photos) {
                $allPhotos = $featuredGallery->photos->map(function($photo) {
                    // Normalize path: convert old "gallery/..." to "images/gallery/..." for consistency
                    $normalizedPath = $photo->path;
                    if (strpos($normalizedPath, 'images/gallery/') !== 0 && strpos($normalizedPath, 'gallery/') === 0) {
                        $normalizedPath = str_replace('gallery/', 'images/gallery/', $normalizedPath);
                    }
                    return [
                        'id' => $photo->id,
                        'path' => $normalizedPath,
                        'description' => $photo->description ?? ''
                    ];
                })->toArray();
                
                // Shuffle and take only 6 random images
                shuffle($allPhotos);
                $featuredGalleryPhotos = array_slice($allPhotos, 0, 6);
            }
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load featured gallery - '.$e->getMessage());
        }

        try {
            $groups = Gallery::all();
            foreach ($groups as $group) {
                try {
                    $group_photo_ids = GroupPhotos::where('group_id', $group->id)->get();
                    $photoData = [];
                    foreach ($group_photo_ids as $group_photo_id) {
                        try {
                            $pic = Photos::where('id', $group_photo_id->photo_id)->first();
                            if ($pic) {
                                // Normalize path: convert old "gallery/..." to "images/gallery/..." for consistency
                                $normalizedPath = $pic->path;
                                if (strpos($normalizedPath, 'images/gallery/') !== 0 && strpos($normalizedPath, 'gallery/') === 0) {
                                    $normalizedPath = str_replace('gallery/', 'images/gallery/', $normalizedPath);
                                }
                                $pic->path = $normalizedPath;
                                $photoData[] = $pic;
                            }
                        } catch (\Throwable $e) {
                            // Skip this photo if there's an error
                            continue;
                        }
                    }
                    if (!empty($photoData)) {
                        $galleries[] = [
                            'gallery_id' => $group->id,
                            'name' => $group->name,
                            'photos' => $photoData
                        ];
                    }
                } catch (\Throwable $e) {
                    // Skip this gallery if there's an error
                    continue;
                }
            }
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load galleries - '.$e->getMessage());
        }

        try {
            // Get active announcements for homepage (not expired)
            $nowTimestamp = now()->timestamp;
            
            $announcements = Announcement::where(function($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })->get();
            
            // Filter out expired announcements using strict timestamp comparison
            $announcements = $announcements->filter(function($announcement) use ($nowTimestamp) {
                if ($announcement->expires_at === null) {
                    return true;
                }
                
                $expiresTimestamp = $announcement->expires_at instanceof \Carbon\Carbon 
                    ? $announcement->expires_at->timestamp 
                    : (is_string($announcement->expires_at) ? strtotime($announcement->expires_at) : $announcement->expires_at);
                
                return $expiresTimestamp > $nowTimestamp;
            })
            ->sortByDesc('created_at')
            ->take(10)
            ->values();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load announcements - '.$e->getMessage());
        }

        try {
            $partners = Partner::active()->ordered()->get();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load partners - '.$e->getMessage());
        }

        try {
            $products = Product::visibleOnFrontend()->ordered()->get();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load products - '.$e->getMessage());
        }

        try {
            $carouselSlides = Carousel::select('title', 'middletxt', 'btmtxt', 'image')->orderBy('created_at', 'desc')->get();
        } catch (\Throwable $e) {
            Log::error('Home page: Failed to load carousel slides - '.$e->getMessage());
        }

        return view('home', compact('services', 'testimonials', 'blog', 'galleries', 'featuredGalleryPhotos', 'announcements', 'partners', 'products', 'carouselSlides'));
    }
}