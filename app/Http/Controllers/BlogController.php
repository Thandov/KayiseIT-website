<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\PostCategories;
use App\Helpers\UploadHelper;



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
        $postCategories = PostCategories::all();
        return view('admin/blogs/addblog', compact('postCategories'));
    }

    public function storeblog(Request $request)
    {

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg|max:5048',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $profilePicture = "";
        $name = $request->title;

        if ($request->hasFile('profile_picture') && !empty($request->hasFile('profile_picture'))) {
            $profilePicture = $request->file('profile_picture');
            $path = 'images/categories/'; // Set the desired path dynamically here

            try {
                $profilePicturePath = UploadHelper::uploadProfilePicture($profilePicture, $path, $name);
            } catch (\Exception $e) {
                // Handle the exception here
                dd($e->getMessage());
                return redirect()->back()->withErrors(['profile_picture' => $e->getMessage()]);
            }

            // Do something with the $profilePicturePath, like saving it to the database, etc.
        } else {
            $profilePicturePath = "null";
        }
        $blog = new Blog;
        $blog->icon = $profilePicturePath;
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->content = $request->content;
        $blog->category_no = 1;
        $blog->save();
        $blogs = Blog::all();
        return redirect()->route('admin.blogs.blog');
    }
    public function destroyblog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->back()->with('success', 'blog has been deleted!');
    }

    public function updateblog(Request $request, $id)
    {
       
        // Find the blog by its ID
        $blog = Blog::findOrFail($id);
        // Get the new data from the request
        $newTitle = $request->input('title');
        $newSubtitle = $request->input('subtitle');
        $newContent = $request->input('content');

        // Check if any of the values have changed
        $hasChanged = false;
        if ($blog->title !== $newTitle) {
            $blog->title = $newTitle;
            $hasChanged = true;
        }

        if ($blog->subtitle !== $newSubtitle) {
            $blog->subtitle = $newSubtitle;
            $hasChanged = true;
        }

        if ($blog->content !== $newContent) {
            $blog->content = $newContent;
            $hasChanged = true;
        }
        $name = $request->title;

        if ($request->hasFile('profile_picture') && !empty($request->hasFile('profile_picture'))) {
            $profilePicture = $request->file('profile_picture');
            $path = 'images/blogs/'; // Set the desired path dynamically here
            $hasChanged = true;
            try {
                $profilePicturePath = UploadHelper::uploadProfilePicture($profilePicture, $path, $name);
            } catch (\Exception $e) {
                // Handle the exception here
                dd($e->getMessage());
                return redirect()->back()->withErrors(['profile_picture' => $e->getMessage()]);
            }

            // Do something with the $profilePicturePath, like saving it to the database, etc.
            $blog->icon = $profilePicturePath;
        } else {
            $profilePicturePath = "null";
        }
        // If any of the values have changed, save the blog and return a success message
        if ($hasChanged) {
            $blog->save();
            return redirect()->back()->with('success', 'Blog updated successfully');
        } else {
            // If none of the values have changed, return a message indicating that there were no changes
            return redirect()->back()->with('error', 'No changes made to the blog');
        }
    }


    public function viewblog_edit($id)
    {
        $blog = Blog::find($id);
        return view('admin/blogs/viewblog_edit', compact('blog'));
    }

    public function viewblog($id)
    {
        $blog = Blog::find($id);
        return view('admin/blogs/viewblog', compact('blog'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json([
                'fileName' => $fileName, 'uploaded' => 1, 'url' => $url
            ]);
        }
    }
}