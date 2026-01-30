<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource (Admin).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $announcements = Announcement::orderBy('created_at', 'desc')->paginate(12);
        } catch (\Exception $e) {
            // If there's an error (e.g., table doesn't exist), create an empty paginator
            $announcements = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]),
                0,
                12,
                1
            );
        }
        
        $isAdmin = true;
        $pageTitle = 'Announcements Management';
        return view('admin.dashboard.announcements.index-wrapper', compact('announcements', 'isAdmin', 'pageTitle'));
    }
    
    /**
     * Scope to get only non-expired announcements
     */
    private function scopeActiveNotExpired($query)
    {
        return $query->where(function($q) {
            $q->where('is_active', true)
              ->orWhereNull('is_active');
        })->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    /**
     * Display a listing of announcements for public viewing.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicIndex()
    {
        try {
            $announcements = Announcement::where(function($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        } catch (\Exception $e) {
            $announcements = collect([])->paginate(12);
        }
        
        return view('announcements', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isAdmin = true;
        $pageTitle = 'Create New Announcement';
        return view('admin.dashboard.announcements.create', compact('isAdmin', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'link' => 'nullable|url|max:255',
                'badge' => 'nullable|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'expires_at' => 'nullable|date|after:today'
            ]);

            $announcement = new Announcement();
            $announcement->title = $validatedData['title'];
            $announcement->message = $validatedData['description']; // message is required, use description value
            $announcement->description = $validatedData['description'];
            $announcement->link = $validatedData['link'] ?? null;
            $announcement->badge = $validatedData['badge'] ?? null;
            
            // Set expiration date: default to 7 days from now if not provided
            if ($request->filled('expires_at')) {
                $announcement->expires_at = $validatedData['expires_at'];
            } else {
                $announcement->expires_at = now()->addDays(7);
            }

            // Save announcement first to get the ID
            $announcement->save();

            // Handle image upload - create folder structure: Announcements/{announcement_id}/
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
                
                if ($image->isValid()) {
                    // Create folder structure: Announcements/{announcement_id}/
                    $folderPath = 'Announcements/' . $announcement->id;
                    $fullFolderPath = public_path($folderPath);
                    
                    // Create directory if it doesn't exist
                    if (!File::exists($fullFolderPath)) {
                        File::makeDirectory($fullFolderPath, 0755, true);
                    }
                    
                    // Store image in the announcement's folder
                    $image->move($fullFolderPath, $originalName);
                    $announcement->image = '/' . $folderPath . '/' . $originalName;
            $announcement->save();
                }
            }

            if ($request->ajax()) {
                return response()->json(['message' => 'Announcement created successfully.']);
            }

            return redirect()->route('admin.dashboard.announcements.index')
                ->with('success', 'Announcement created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create announcement: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            $isAdmin = true;
            $pageTitle = 'Announcement: ' . $announcement->title;
            return view('admin.dashboard.announcements.show', compact('announcement', 'isAdmin', 'pageTitle'));
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard.announcements.index')
                ->with('error', 'Announcement not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            $isAdmin = true;
            $pageTitle = 'Edit Announcement: ' . $announcement->title;
            return view('admin.dashboard.announcements.edit', compact('announcement', 'isAdmin', 'pageTitle'));
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard.announcements.index')
                ->with('error', 'Announcement not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            
            $validatedData = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string',
                'link' => 'nullable|url|max:255',
                'badge' => 'nullable|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'expires_at' => 'nullable|date|after:today'
            ]);

            if ($request->filled('title')) {
                $announcement->title = $validatedData['title'];
            }

            if ($request->filled('description')) {
                $announcement->message = $validatedData['description']; // message is required, use description value
                $announcement->description = $validatedData['description'];
            }

            if ($request->has('link')) {
                $announcement->link = $validatedData['link'] ?? null;
            }

            if ($request->has('badge')) {
                $announcement->badge = $validatedData['badge'] ?? null;
            }
            
            // Update expiration date if provided
            if ($request->has('expires_at')) {
                $announcement->expires_at = $validatedData['expires_at'] ?? null;
            }

            // Handle image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete the previous image if it exists
                if ($announcement->image) {
                    $oldImagePath = public_path(ltrim($announcement->image, '/'));
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                // Create folder structure: Announcements/{announcement_id}/
                $folderPath = 'Announcements/' . $announcement->id;
                $fullFolderPath = public_path($folderPath);
                
                // Create directory if it doesn't exist
                if (!File::exists($fullFolderPath)) {
                    File::makeDirectory($fullFolderPath, 0755, true);
                }

                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
                
                // Store image in the announcement's folder
                $image->move($fullFolderPath, $originalName);
                $announcement->image = '/' . $folderPath . '/' . $originalName;
            }

            $announcement->save();

            return redirect()->route('admin.dashboard.announcements.index')
                ->with('success', 'Announcement updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update announcement: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            
            // Delete the entire announcement folder if it exists
            $folderPath = public_path('Announcements/' . $announcement->id);
            if (File::exists($folderPath)) {
                File::deleteDirectory($folderPath);
            }
            
            $announcement->delete();
            
            if ($request->ajax()) {
                return response()->json(['message' => 'Announcement deleted successfully.']);
            }

            return redirect()->route('admin.dashboard.announcements.index')
                ->with('success', 'Announcement deleted successfully.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Announcement not found.'], 404);
            }

            return redirect()->route('admin.dashboard.announcements.index')
                ->with('error', 'Announcement not found.');
        }
    }
}

