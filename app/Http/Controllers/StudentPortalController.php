<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Blog;
use App\Models\InternshipApplication;

class StudentPortalController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the student portal dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user->hasRole('student')) {
            return redirect()->route('home')->with('error', 'Access denied. Student portal is for students only.');
        }

        $announcements = Announcement::where(function ($q) {
            $q->where('is_active', true)->orWhereNull('is_active');
        })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        $recentBlogs = Blog::orderByDesc('created_at')->take(3)->get();

        $internshipApplication = null;
        if (class_exists(InternshipApplication::class)) {
            $internshipApplication = InternshipApplication::where('user_id', $user->id)->first();
        }

        return view('student.dashboard', compact('announcements', 'recentBlogs', 'internshipApplication'));
    }
}
