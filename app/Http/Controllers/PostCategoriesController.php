<?php

namespace App\Http\Controllers;

use App\Models\PostCategories;
use Illuminate\Http\Request;

class PostCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategories::select('cat_id as Category ID', 'category_name as Category Name')->get();
        return view('/admin/blogs/categories', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:post_categories|max:255',
        ]);

        $postCategory = new PostCategories;
        $postCategory->category_name = $request->category_name;
        do {
            // Generate a random 3-digit number
            $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

            // Prepend "cat_" to the random number to create cat_id
            $postCategory->cat_id = 'cat_' . $randomNumber;

            // Check if the generated cat_id already exists in the database
            $existingCategory = PostCategories::where('cat_id', $postCategory->cat_id)->first();
        } while ($existingCategory);
        $postCategory->save();

        return back()->with('success', 'Post category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostCategories  $postCategories
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategories $postCategories)
    {
        // You can show a specific category if needed, but it's optional.
        // You can leave this method empty if you don't plan to use it.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostCategories  $postCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategories $postCategory)
    {
        return view('admin.blogs.categories.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategories  $postCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategories $postCategory)
    {
        $request->validate([
            'category_name' => 'required|unique:post_categories,category_name,' . $postCategory->id . '|max:255',
        ]);

        $postCategory->category_name = $request->category_name;
        $postCategory->save();

        return redirect()->route('admin.blogs.blog')
                         ->with('success', 'Post category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostCategories  $postCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCategory = PostCategories::where('cat_id', $id)->firstOrFail();
        $postCategory->delete();

        return redirect()->route('admin.blogs.categories')->with('success', 'Post category deleted successfully.');
    }
}