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
        $carousels = DB::table('carousels')
            ->select('carousels.*')
            ->get();

        return view('/admin/carousel/carousel', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $validatedData = $request->validate(['head_title' => 'required|string|max:255',
                'middletxt' => 'required|string|max:255',
                'btmtxt' => 'required|string|max:255',
            ]);

            // Set values for other user fields
            $carousel = new Carousel();
            $carousel->user_id = $userId;
            $carousel->title = $validatedData['head_title'];
            $carousel->middletxt = $validatedData['middletxt'];
            $carousel->btmtxt = $validatedData['btmtxt'];
            $originalName = $request->file('profile_picture')->getClientOriginalName();

            // Handle profile picture upload
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture');
                $carousel->image = $originalName;


                if ($profilePicture->isValid()) {


                    $extension = $profilePicture->getClientOriginalExtension();

                    $profilePicture->storeAs('/images/carousel', $originalName);
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

            return redirect()->route('admin.carousel.viewcarousel', ['id' => $carouselID])->with('success', 'Carousel created successfully.');
        } catch (ValidationException $e) {
            dd("fAIL");
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
        $carousel = Carousel::find($id)->first();

        return view('admin/carousel/viewcarousel', compact('carousel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        $changedFields = [];

        if ($request->filled('title')) {
            $carousel->title = $request->input('title');
            $changedFields[] = 'title';
        }

        if ($request->filled('middletxt')) {
            $carousel->middletxt = $request->input('middletxt');
            $changedFields[] = 'middletxt';
        }

        if ($request->filled('btmtxt')) {
            $carousel->btmtxt = $request->input('btmtxt');
            $changedFields[] = 'btmtxt';
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete the previous image if it exists
            if ($carousel->image && Storage::exists('images/carousel/' . $carousel->image)) {
                Storage::delete('images/carousel/' . $carousel->image);
            }

            $imagePath = $request->file('image')->store('images/carousel', 'public');
            $carousel->image = $imagePath;
            $changedFields[] = 'image';
        }

        // Save the carousel model if any changes were made to the carousel fields
        if (!empty($changedFields)) {
            $carousel->save();
        }

        return redirect()->back()->with('success', 'Carousel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $id = (int)$id;
        $carousel = DB::table('carousels')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $carousel->user_id)->first();

        if ($carousel) {
            // Perform your desired operations with the $carousel and $user models
            DB::table('carousels')->where('id', $id)->delete();
            if ($request->ajax()) {
                return response()->json(['message' => 'Carousel and associated user have been deleted.']);
            }

            return redirect()->route('admin.carousel')->with('success', 'Carousel and associated user have been deleted.');
        } else {
            if ($request->ajax()) {
                return response()->json(['message' => 'Carousel or associated user not found.'], 404);
            }

            return redirect()->route('admin.carousel')->with('error', 'Carousel or associated user not found.');
        }
    }
}