<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photos;
use App\Models\GroupPhotos;
use App\Helpers\ImageOptimizer;
use App\Helpers\ImagePathResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Import the File facade


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
        foreach ($groups as $group) {
            $group_photo_ids = GroupPhotos::where('group_id', $group->id)->get();
            // Prepare an array to hold photo data for the current group
            $photoData = [];
            foreach ($group_photo_ids as $group_photo_id) {
                // For each group photo, fetch the actual photo
                $pic = Photos::where('id', $group_photo_id->photo_id)->first(); // Use first() if you expect a single photo
                if ($pic) {
                    // Normalize path: convert old "gallery/..." to "images/gallery/..." for consistency
                    $normalizedPath = $pic->path;
                    if (strpos($normalizedPath, 'images/gallery/') !== 0 && strpos($normalizedPath, 'gallery/') === 0) {
                        $normalizedPath = str_replace('gallery/', 'images/gallery/', $normalizedPath);
                    }
                    // If a photo is found, add it to the photo data array as an array for easier access in views
                    $photoData[] = [
                        'id' => $pic->id,
                        'path' => $normalizedPath,
                        'description' => $pic->description ?? '',
                        'user_id' => $pic->user_id ?? null
                    ];
                }
            }
            // Include all galleries, even if empty
            $galleries[] = [
                'gallery_id' => $group->id,
                'name' => $group->name,
                'description' => $group->description ?? '',
                'featured_on_homepage' => $group->featured_on_homepage ?? false,
                'photos' => $photoData
            ];
        }
        // Get all categories for the dropdown
        $categories = Gallery::all();
        return view('admin.dashboard.gallery.index', compact('galleries', 'categories'));
    }

    public function gallery()
    {
        // Use Eloquent relationships for better performance
        $galleries = Gallery::with('photos')
            ->whereHas('photos') // Only get galleries that have photos
            ->get()
            ->map(function ($gallery) {
                return [
                    'gallery_id' => $gallery->id,
                    'name' => $gallery->name,
                    'description' => $gallery->description,
                    'photos' => $gallery->photos->map(function ($photo) {
                        // Normalize path: convert old "gallery/..." to "images/gallery/..." for consistency
                        $normalizedPath = $photo->path;
                        if (strpos($normalizedPath, 'images/gallery/') !== 0 && strpos($normalizedPath, 'gallery/') === 0) {
                            $normalizedPath = str_replace('gallery/', 'images/gallery/', $normalizedPath);
                        }
                        return [
                            'id' => $photo->id,
                            'path' => $normalizedPath,
                            'description' => $photo->description ?? '',
                            'user_id' => $photo->user_id ?? null
                        ];
                    })->toArray()
                ];
            })
            ->toArray();

        return view('gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        try {
            $tt = $request->input('newCategory');
            $galleryGroupId = null;
            $galleryGroup = null;
            
            if ($request->input('category') == 'add_cat') {
                // Validate new category name
                if (empty($tt) || !trim($tt)) {
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(['success' => false, 'message' => 'Category name is required.'], 400);
                    }
                    return back()->with('error', 'Category name is required.');
                }
                
                // Create new gallery group
                $galleryGroup = Gallery::create([
                    'user_id' => Auth::user()->id,
                    'name' => trim($tt),
                    'description' => $request->input('description', '')
                ]);

                $galleryGroupId = $galleryGroup->id;
                $galleryFolderName = Str::slug($galleryGroup->name);
            } else {
                // Use existing category
                $galleryGroupId = $request->input('category');
                $galleryGroup = Gallery::find($galleryGroupId);
                
                if (empty($galleryGroup)) {
                    // Try to find by name as fallback
                    $galleryGroup = Gallery::where('name', $galleryGroupId)->first();
                }
                
                if (empty($galleryGroup)) {
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(['success' => false, 'message' => 'Selected category not found.'], 404);
                    }
                    return back()->with('error', 'Selected category not found.');
                }
                
                $galleryFolderName = Str::slug($galleryGroup->name);
            }
            
            if (!$request->hasFile('images')) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'No images provided.'], 400);
                }
                return back()->with('error', 'No images provided.');
            }
            
            // Store in public/images/gallery/{category_name} (same pattern as carousel)
            $galleryStoragePath = "images/gallery/{$galleryFolderName}";
            $fullGalleryPath = public_path($galleryStoragePath);
            if (!File::exists($fullGalleryPath)) {
                File::makeDirectory($fullGalleryPath, 0755, true);
            }
            
            $uploadedCount = 0;
            foreach ($request->file('images') as $image) {
                // Optimize the image before storing in images/gallery/{category_name}
                $optimizedPath = ImageOptimizer::optimize(
                    $image,
                    $galleryStoragePath,
                    [
                        'max_width' => 1920,
                        'max_height' => 1080,
                        'quality' => 85,
                        'format' => 'auto' // Will use WebP if available, else original format
                    ]
                );
                
                // Link the optimized image to the gallery group
                $photo = Photos::create([
                    'user_id' => Auth::user()->id,
                    'path' => $optimizedPath,
                    'description' => $request->input('photo_description', '')
                ]);
                
                GroupPhotos::create([
                    'group_id' => $galleryGroup->id,
                    'photo_id' => $photo->id
                ]);
                
                $uploadedCount++;
            }
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Successfully uploaded {$uploadedCount} image(s).",
                    'count' => $uploadedCount
                ]);
            }
            
            return back()->with('success', "Successfully uploaded {$uploadedCount} image(s).");
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Upload failed: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified gallery.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);
            
            $gallery->update([
                'name' => $request->input('name'),
                'description' => $request->input('description', '')
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gallery updated successfully.',
                    'gallery' => $gallery
                ]);
            }
            
            return back()->with('success', 'Gallery updated successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    /**
     * Delete a gallery category and all its photos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            // Get all photos in this gallery
            $groupPhotos = GroupPhotos::where('group_id', $id)->get();
            
            foreach ($groupPhotos as $groupPhoto) {
                $photo = Photos::find($groupPhoto->photo_id);
                if ($photo) {
                    // Delete the file
                    $filePath = storage_path('app/public/' . $photo->path);
                    $publicPath = public_path($photo->path);
                    
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    } elseif (File::exists($publicPath)) {
                        File::delete($publicPath);
                    }
                    
                    // Delete the photo record
                    $photo->delete();
                }
                
                // Delete the group photo relationship
                $groupPhoto->delete();
            }
            
            // Delete the gallery category
            $gallery->delete();
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gallery category and all its photos have been deleted.'
                ]);
            }
            
            return redirect()->route('dashboard.gallery')->with('success', 'Gallery category and all its photos have been deleted.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Delete failed: ' . $e->getMessage()], 500);
            }
            return redirect()->route('dashboard.gallery')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            // Validate input
            if (!is_numeric($id) || $id <= 0) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Invalid photo ID.'], 400);
                }
                return redirect()->route('dashboard.gallery')->with('error', 'Invalid photo ID.');
            }

            // Find the photo and its group relationship
            $photo = Photos::find($id);
            
            if (!$photo) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Photo not found.'], 404);
                }
                return redirect()->route('dashboard.gallery')->with('error', 'Photo not found.');
            }

            $photoGroup = GroupPhotos::where('photo_id', $id)->first();
            
            // Delete primary file and any related originals/variants from storage
            self::deletePhotoFiles($photo->path);

            // Delete the group relationship if it exists
            if ($photoGroup) {
                $photoGroup->delete();
            }
            
            // Delete the photo record
            $photo->delete();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Photo and associated file have been deleted.'
                ]);
            }

            return redirect()->route('dashboard.gallery')->with('success', 'Photo and associated file have been deleted.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Delete failed: ' . $e->getMessage()], 500);
            }
            return redirect()->route('dashboard.gallery')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    /**
     * Bulk delete multiple photos and their files.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No photos selected for deletion.'
            ], 400);
        }

        try {
            $deletedCount = 0;

            foreach ($ids as $id) {
                if (!is_numeric($id) || $id <= 0) {
                    continue;
                }

                $photo = Photos::find($id);
                if (!$photo) {
                    continue;
                }

                // Remove file from storage/public, including originals/variants
                self::deletePhotoFiles($photo->path);

                // Remove group relationships
                GroupPhotos::where('photo_id', $id)->delete();

                // Delete DB record
                $photo->delete();

                $deletedCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Deleted {$deletedCount} photo(s).",
                'deleted' => $deletedCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bulk delete failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a photo file and any obvious original/variant versions from storage.
     *
     * @param string $relativePath Path stored in DB (relative to storage/app/public)
     * @return void
     */
    protected static function deletePhotoFiles(string $relativePath): void
    {
        if (empty($relativePath)) {
            return;
        }

        $pathsToTry = [];

        // Always try the stored path first
        $pathsToTry[] = $relativePath;

        $pathInfo = pathinfo($relativePath);
        $dirname = $pathInfo['dirname'] ?? '';
        $filename = $pathInfo['filename'] ?? '';
        $extension = strtolower($pathInfo['extension'] ?? '');

        // If filename contains "_opt", also try without it
        $baseFilename = str_replace('_opt', '', $filename);

        // Potential original/variant extensions
        $possibleExts = ['jpg', 'jpeg', 'png', 'webp'];

        foreach ($possibleExts as $ext) {
            // Same filename (if not already this combo)
            $candidate1 = trim($dirname !== '' ? $dirname . '/' : '') . $baseFilename . '.' . $ext;
            if ($candidate1 !== $relativePath) {
                $pathsToTry[] = $candidate1;
            }
        }

        // Deduplicate candidate paths
        $pathsToTry = array_values(array_unique(array_filter($pathsToTry)));

        foreach ($pathsToTry as $path) {
            // Check new location: public/images/gallery/...
            if (strpos($path, 'images/') === 0) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }
            
            // Check legacy locations
            $storagePath = storage_path('app/public/' . $path);
            $publicPath = public_path($path);
            $legacyImagesPath = public_path(str_replace('gallery/', 'images/gallery/', $path));

            if (File::exists($storagePath)) {
                File::delete($storagePath);
            }
            if (File::exists($publicPath)) {
                File::delete($publicPath);
            }
            if (File::exists($legacyImagesPath)) {
                File::delete($legacyImagesPath);
            }
        }
    }

    /**
     * Store a new gallery category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);
            
            $gallery = Gallery::create([
                'user_id' => Auth::user()->id,
                'name' => $request->input('name'),
                'description' => $request->input('description', '')
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category created successfully.',
                    'gallery' => $gallery
                ]);
            }
            
            return back()->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to create category: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to create category: ' . $e->getMessage());
        }
    }

    /**
     * Set featured gallery for homepage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setFeatured(Request $request, $id)
    {
        try {
            // First, unset all other featured galleries
            Gallery::where('featured_on_homepage', true)->update(['featured_on_homepage' => false]);
            
            // Set the selected gallery as featured
            $gallery = Gallery::findOrFail($id);
            $gallery->update(['featured_on_homepage' => true]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gallery set as featured on homepage.',
                    'gallery' => $gallery
                ]);
            }
            
            return back()->with('success', 'Gallery set as featured on homepage.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to set featured gallery: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to set featured gallery: ' . $e->getMessage());
        }
    }

    /**
     * Update homepage section copy for a gallery (badge, heading, subheading).
     */
    public function updateHomepageSection(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            $request->validate([
                'homepage_badge' => 'nullable|string|max:100',
                'homepage_title' => 'nullable|string|max:255',
                'homepage_subtitle' => 'nullable|string|max:1000',
            ]);

            $gallery->update([
                'homepage_badge' => $request->input('homepage_badge') ?: null,
                'homepage_title' => $request->input('homepage_title') ?: null,
                'homepage_subtitle' => $request->input('homepage_subtitle') ?: null,
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Homepage section updated.',
                    'gallery' => $gallery->fresh(),
                ]);
            }

            return back()->with('success', 'Homepage section updated.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to update homepage section: ' . $e->getMessage()], 500);
            }

            return back()->with('error', 'Failed to update homepage section: ' . $e->getMessage());
        }
    }
}
