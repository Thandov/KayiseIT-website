<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousel::select('id', 'user_id', 'title', 'middletxt', 'btmtxt', 'image')
            ->paginate(10);
        $isAdmin = true;
        return view('admin/dashboard/carousel/index', compact('carousels', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isAdmin = true;
        return view('admin/dashboard/carousel/create', compact('isAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        try {
            $validatedData = $request->validate([
                'head_title' => 'required|string|max:255',
                'middletxt' => 'required|string|max:255',
                'btmtxt' => 'required|string|max:255',
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Set values for other user fields
            $carousel = new Carousel();
            $carousel->user_id = $userId;
            $carousel->title = $validatedData['head_title'];
            $carousel->middletxt = $validatedData['middletxt'];
            $carousel->btmtxt = $validatedData['btmtxt'];

            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture');
                $originalName = $profilePicture->getClientOriginalName();
                
                if ($profilePicture->isValid()) {
                    $profilePicture->storeAs('/images/carousel', $originalName);
                    $carousel->image = '/images/carousel/' . $originalName;
                } else {
                    throw ValidationException::withMessages([
                        'profile_picture' => 'The profile picture is not valid.',
                    ]);
                }
            }

            $carousel->save();
            $carouselID = $carousel->id;
            
            if ($request->ajax()) {
                return response()->json(['message' => 'Carousel created successfully.']);
            }

            return redirect()->route('admin.dashboard.carousel.show', ['id' => $carouselID])->with('success', 'Carousel created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carousel = Carousel::findOrFail($id);
        $isAdmin = true;
        return view('admin/dashboard/carousel/show', compact('carousel', 'isAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        $isAdmin = true;
        return view('admin/dashboard/carousel/edit', compact('carousel', 'isAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $carousel = Carousel::findOrFail($id);
            
            $validatedData = $request->validate([
                'head_title' => 'sometimes|required|string|max:255',
                'middletxt' => 'sometimes|required|string|max:255',
                'btmtxt' => 'sometimes|required|string|max:255',
                'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $changedFields = [];

            if ($request->filled('head_title')) {
                $carousel->title = $validatedData['head_title'];
                $changedFields[] = 'title';
            }

            if ($request->filled('middletxt')) {
                $carousel->middletxt = $validatedData['middletxt'];
                $changedFields[] = 'middletxt';
            }

            if ($request->filled('btmtxt')) {
                $carousel->btmtxt = $validatedData['btmtxt'];
                $changedFields[] = 'btmtxt';
            }

            if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
                // Delete the previous image if it exists
                if ($carousel->image && Storage::exists('public' . $carousel->image)) {
                    Storage::delete('public' . $carousel->image);
                }

                $originalName = $request->file('profile_picture')->getClientOriginalName();
                $request->file('profile_picture')->storeAs('/images/carousel', $originalName);
                $carousel->image = '/images/carousel/' . $originalName;
                $changedFields[] = 'image';
            }

            $carousel->user_id = Auth::id();

            // Save the carousel model if any changes were made to the carousel fields
            if (!empty($changedFields)) {
                $carousel->save();
            }
            
            return redirect()->route('admin.dashboard.carousel.show', $id)->with('success', 'Carousel updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $carousel = Carousel::findOrFail($id);
            
            // Delete the associated image if it exists
            if ($carousel->image && Storage::exists('public' . $carousel->image)) {
                Storage::delete('public' . $carousel->image);
            }
            
            $carousel->delete();
            
            if ($request->ajax()) {
                return response()->json(['message' => 'Carousel deleted successfully.']);
            }

            return redirect()->route('admin.dashboard.carousel')->with('success', 'Carousel deleted successfully.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Carousel not found.'], 404);
            }

            return redirect()->route('admin.dashboard.carousel')->with('error', 'Carousel not found.');
        }
    }
}