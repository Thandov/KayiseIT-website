<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\CaseStudyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caseStudies = CaseStudy::with('galleryImages')->orderBy('order')->orderBy('created_at', 'desc')->paginate(10);
        $isAdmin = true;
        $pageTitle = 'Case Studies Management';
        return view('admin.dashboard.case-studies.index-wrapper', compact('caseStudies', 'isAdmin', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isAdmin = true;
        $pageTitle = 'Create Case Study';
        return view('admin.dashboard.case-studies.create', compact('isAdmin', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hyperlink' => 'nullable|url|max:500',
            'has_gallery' => 'nullable|boolean',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'results' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        // Handle checkboxes - they don't send a value if unchecked
        $validatedData['is_featured'] = $request->has('is_featured') ? true : false;
        $validatedData['is_active'] = $request->has('is_active') ? true : false;
        $validatedData['has_gallery'] = $request->has('has_gallery') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images/case-studies', $imageName);
            $validatedData['image'] = '/storage/images/case-studies/' . $imageName;
        }

        // Handle results_list if provided
        if ($request->has('results_list')) {
            $resultsList = [];
            foreach ($request->results_list as $result) {
                if (!empty($result['text'])) {
                    $resultsList[] = $result;
                }
            }
            $validatedData['results_list'] = $resultsList;
        }

        $caseStudy = CaseStudy::create($validatedData);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $galleryImage) {
                $imageName = time() . '_' . $index . '_' . $galleryImage->getClientOriginalName();
                $galleryImage->storeAs('public/images/case-studies/gallery', $imageName);
                CaseStudyImage::create([
                    'case_study_id' => $caseStudy->id,
                    'image_path' => '/storage/images/case-studies/gallery/' . $imageName,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('dashboard.case-studies.index')
            ->with('success', 'Case study created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caseStudy = CaseStudy::with('galleryImages')->findOrFail($id);
        $isAdmin = true;
        $pageTitle = 'View Case Study';
        return view('admin.dashboard.case-studies.show', compact('caseStudy', 'isAdmin', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caseStudy = CaseStudy::with('galleryImages')->findOrFail($id);
        $isAdmin = true;
        $pageTitle = 'Edit Case Study';
        return view('admin.dashboard.case-studies.edit', compact('caseStudy', 'isAdmin', 'pageTitle'));
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
        $caseStudy = CaseStudy::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hyperlink' => 'nullable|url|max:500',
            'has_gallery' => 'nullable|boolean',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'results' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        // Handle checkboxes - they don't send a value if unchecked
        $validatedData['is_featured'] = $request->has('is_featured') ? true : false;
        $validatedData['is_active'] = $request->has('is_active') ? true : false;
        $validatedData['has_gallery'] = $request->has('has_gallery') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($caseStudy->image && Storage::exists(str_replace('/storage/', 'public/', $caseStudy->image))) {
                Storage::delete(str_replace('/storage/', 'public/', $caseStudy->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images/case-studies', $imageName);
            $validatedData['image'] = '/storage/images/case-studies/' . $imageName;
        }

        // Handle results_list if provided
        if ($request->has('results_list')) {
            $resultsList = [];
            foreach ($request->results_list as $result) {
                if (!empty($result['text'])) {
                    $resultsList[] = $result;
                }
            }
            $validatedData['results_list'] = $resultsList;
        }

        $caseStudy->update($validatedData);

        // Handle gallery images - add new ones
        if ($request->hasFile('gallery_images')) {
            $existingCount = $caseStudy->galleryImages()->count();
            foreach ($request->file('gallery_images') as $index => $galleryImage) {
                $imageName = time() . '_' . ($existingCount + $index) . '_' . $galleryImage->getClientOriginalName();
                $galleryImage->storeAs('public/images/case-studies/gallery', $imageName);
                CaseStudyImage::create([
                    'case_study_id' => $caseStudy->id,
                    'image_path' => '/storage/images/case-studies/gallery/' . $imageName,
                    'order' => $existingCount + $index,
                ]);
            }
        }

        // Handle gallery image deletion
        if ($request->has('delete_gallery_images')) {
            foreach ($request->delete_gallery_images as $imageId) {
                $galleryImage = CaseStudyImage::find($imageId);
                if ($galleryImage && $galleryImage->case_study_id == $caseStudy->id) {
                    if (Storage::exists(str_replace('/storage/', 'public/', $galleryImage->image_path))) {
                        Storage::delete(str_replace('/storage/', 'public/', $galleryImage->image_path));
                    }
                    $galleryImage->delete();
                }
            }
        }

        return redirect()->route('dashboard.case-studies.index')
            ->with('success', 'Case study updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        $caseStudy->delete();

        return redirect()->route('dashboard.case-studies.index')
            ->with('success', 'Case study deleted successfully.');
    }
}
