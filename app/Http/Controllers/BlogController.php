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
          
        return view('/admin/blogs/blog')->with('success', 'blog post added successfully');
    }

    public function blogpage()
    {
        $blog = Blog::all();
        return view('blog', compact('blog'));
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
}
