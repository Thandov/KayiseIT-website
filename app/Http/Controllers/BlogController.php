<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    //
    public function blog()
    {
        $blogs = Blog::all();
        return view('admin.blogs.view_all_blogs', compact('blogs'));
    }
    
    public function addblog()
    {
        return view('admin/blogs/addblog');
    }

    public function storeblog(Request $request)
    {
        $request->validate([
            'icon' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '_' . $request->name . '.' . $request->icon->extension();

        $request->icon->move(public_path('images'), $newImageName);
        

        $blog = new Blog;
        $blog->icon = $newImageName;
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->content = $request->content;
        $blog->save();
        
        return view('/admin/blogs/blog', compact('blogs'))->with('success', 'blog post added successfully');
    }

    public function blogpage()
    {
        $blogs = Blog::all();
        return view('blog', compact('blogs'));
    }
   

    public function destroyblog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->back()->with('success', 'blog has been deleted!');
    }

    public function updateblog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->subtitle = $request->input('subtitle');
        $blog->content = $request->input('content');
        $blog->save();
    
        return redirect()->back()->with('success', 'Blog updated successfully');
    }

    public function viewblog($id)
    {
        $blog = Blog::find($id);
        return view('admin/blogs/viewblog', compact('blog'));
    }
    
    public function upload(Request $request)
    {
        if ($request->hasFile('upload'))  {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time(). '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1 
             , 'url' => $url]);
        }
    }

    


}
