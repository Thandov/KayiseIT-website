<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    //
    
    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials', compact('testimonials'));
    }
    
    public function addtestimony()
    {
        return view('admin/addtestimony');
    }

    public function storetestimony(Request $request)
    {
        $request->validate([
            'icon' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '_' . $request->name . '.' . $request->icon->extension();

        $request->icon->move(public_path('images/testimonials'), $newImageName);
        

        $testimony = new Testimonial;
        $testimony->icon = $newImageName;
        $testimony->name = $request->name;
        $testimony->ratings = $request->rating;
        $testimony->testimony = $request->testimony;
        $testimony->save();
          
        return redirect()->route('admin.testimonials')->with('success', 'testimony added successfully');
    }
    
        public function viewtestimonial($id)
        {
            $testimonial = Testimonial::find($id);
            return view('admin/viewtestimonial', compact('testimonial'));
        }

        public function updatetestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = $request->input('name');
        $testimonial->ratings = $request->input('rating');
        $testimonial->testimony = $request->input('testimony');
        $testimonial->save();
    
        return redirect()->route('admin.testimonials', $id)->with('success', 'blog updated successfully');
    }

    public function destroytestimonial($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect()->back()->with('success', 'blog has been deleted!');
    }
}
