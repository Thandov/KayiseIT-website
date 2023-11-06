<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photos;
use App\Models\GroupPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Gallery::all();

        $galleries = [];
        $pictures = [];

        foreach ($groups as $key => $group) {
            $photos = GroupPhotos::where('group_id', $group->id)->get();
            array_push($galleries, ['gallery_id' => $photos[$key]->group_id]);
            foreach ($photos as $key => $photo) {
                array_push($pictures, ['photo_id' => $photo->photo_id]);
            }   
        }
        array_push($galleries, ['photos' => $pictures]); 
        echo '<pre>';
        print_r($galleries);
        echo '</pre>';
        echo "++++++++++";
        exit();
        return view('admin.dashboard.gallery', compact('groups')) ;
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
        //dd($request->file(), $request->input());
        $tt = $request->input('newCategory');
        //gallery_groups
        $galleryGroupId = null;
        if ($request->input('category') == 'add_cat') {
            // Create new gallery group
            $galleryGroup = Gallery::create([
                'user_id' => Auth::user()->id, // Assuming the user is authenticated and you want to link it
                'name' => $tt,
                'description' => 'ddd' // Add your description logic here if available
            ]);

            $galleryGroupId = $galleryGroup->id;
            $galleryFolderName = Str::slug($galleryGroup->name); // Create a slug for the folder name
        } else {
            $galleryGroupId = $request->input('category');  
            $galleryGroup = Gallery::where('name', $galleryGroupId)->first(); // Fetch the gallery group to get its name
            if (empty($galleryGroup)) {
                $galleryGroup = Gallery::create([
                    'user_id' => Auth::user()->id, // Assuming the user is authenticated and you want to link it
                    'name' => $galleryGroupId,
                    'description' => '13io' // Add your description logic here if available
                ]);
            }
            $galleryFolderName = Str::slug($galleryGroup->name);
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Define the path: gallery/{galleryGroup's name}/{image name}
                $path = $image->storeAs("images/gallery/{$galleryFolderName}", $image->getClientOriginalName(), 'public');
                // Link the image to the gallery group (pseudo code - adjust based on your setup)
                $photo = Photos::create([
                    'user_id' => Auth::user()->id, // Assuming the user is authenticated and you want to link it 
                    'path' => $path,
                    'description' => '83297r' // Add your description logic here if available
                ]);
                $photo_group = GroupPhotos::create([
                    'group_id' => $galleryGroup->id,
                    'photo_id' => $photo->id // Add your description logic here if available
                ]);
            }
        }
        return redirect()->route('dashboard.gallery')->with('success', 'Operation successful'); // Redirect back with a success message
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
