<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\PostCategories;
use App\Helpers\UploadHelper;
use App\Services\BlogCarouselSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct(protected BlogCarouselSyncService $carouselSync)
    {
    }

    public function index()
    {
        $blogs = Blog::query()
            ->with(['carouselSlide', 'category'])
            ->latest()
            ->get();

        return view('admin.dashboard.blogs.index', [
            'blogs' => $blogs,
            'isAdmin' => true,
            'pageTitle' => 'Blogs',
        ]);
    }

    public function blog()
    {
        return $this->index();
    }

    public function addblog()
    {
        return view('admin.blogs.addblog', [
            'postCategories' => PostCategories::query()->orderBy('category_name')->get(),
            'isCarouselSlide' => false,
            'blog' => null,
        ]);
    }

    public function storeblog(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:8192',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'category_no' => 'nullable|exists:post_categories,id',
        ]);

        $name = $request->title;
        $profilePicturePath = null;

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            try {
                $profilePicturePath = UploadHelper::uploadProfilePicture(
                    $request->file('profile_picture'),
                    'images/blogs/',
                    $name
                );
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['profile_picture' => $e->getMessage()])->withInput();
            }
        }

        $blog = new Blog;
        $blog->icon = $profilePicturePath;
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->content = $request->content;
        $blog->category_no = $request->filled('category_no') ? $request->input('category_no') : null;
        $blog->save();

        try {
            $this->carouselSync->sync($blog, $request->boolean('as_carousel_slide'), Auth::id());
        } catch (\RuntimeException $e) {
            return redirect()->route('dashboard.blogs')->with('error', $e->getMessage());
        }

        return redirect()->route('dashboard.blogs')->with('success', 'Post published.');
    }

    public function destroyblog($id)
    {
        $blog = Blog::find($id);

        if (! $blog) {
            return redirect()->route('dashboard.blogs')->with('error', 'Post not found.');
        }

        $blog->delete();

        return redirect()->route('dashboard.blogs')->with('success', 'Post deleted. The carousel slide was removed too.');
    }

    public function updateblog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:8192',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'category_no' => 'nullable|exists:post_categories,id',
        ]);

        $blog->title = $request->input('title');
        $blog->subtitle = $request->input('subtitle');
        $blog->content = $request->input('content');
        $blog->category_no = $request->filled('category_no') ? $request->input('category_no') : null;

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            try {
                $blog->icon = UploadHelper::uploadProfilePicture(
                    $request->file('profile_picture'),
                    'images/blogs/',
                    $request->input('title')
                );
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['profile_picture' => $e->getMessage()])->withInput();
            }
        }

        $blog->save();

        try {
            $this->carouselSync->sync($blog->fresh(), $request->boolean('as_carousel_slide'), Auth::id());
        } catch (\RuntimeException $e) {
            return redirect()->route('dashboard.blogs')->with('error', $e->getMessage());
        }

        return redirect()->route('dashboard.blogs')->with('success', 'Post saved.');
    }

    public function toggleCarouselSlide(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        try {
            $this->carouselSync->sync($blog, $request->boolean('as_carousel_slide'), Auth::id());
        } catch (\RuntimeException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $message = $request->boolean('as_carousel_slide')
            ? 'This post is now a homepage carousel slide.'
            : 'Carousel slide removed for this post.';

        return redirect()->back()->with('success', $message);
    }

    public function viewblog_edit($id)
    {
        $blog = Blog::with('carouselSlide')->findOrFail($id);

        return view('admin.blogs.viewblog_edit', [
            'blog' => $blog,
            'isCarouselSlide' => $blog->isCarouselSlide(),
            'postCategories' => PostCategories::query()->orderBy('category_name')->get(),
        ]);
    }

    public function viewblog($id)
    {
        $blogs = Blog::where('id', '!=', $id)->take(3)->get();
        $blog = Blog::find($id);

        return view('admin/blogs/viewblog', compact('blog', 'blogs'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/'.$fileName);

            return response()->json([
                'fileName' => $fileName, 'uploaded' => 1, 'url' => $url,
            ]);
        }
    }
}
