<div x-data="{ openGalleryId: null }">
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if (!empty($galleries))
        <!-- Fast, table-based gallery management -->
        <div class="overflow-x-auto">
            <table class="ki-table min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left font-semibold text-gray-700">Gallery</th>
                        <th class="text-left font-semibold text-gray-700 whitespace-nowrap">Images</th>
                        <th class="text-left font-semibold text-gray-700 whitespace-nowrap">Featured</th>
                        <th class="text-right font-semibold text-gray-700 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($galleries as $gallery)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td>
                                <div class="flex flex-col gap-1">
                                    <span class="font-semibold text-gray-900">{{ $gallery['name'] }}</span>
                                    @if (!empty($gallery['description']))
                                        <span class="text-xs text-gray-500">
                                            {{ \Illuminate\Support\Str::limit($gallery['description'], 80) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ count($gallery['photos']) }} images
                                </span>
                            </td>
                            <td class="whitespace-nowrap">
                                @if($gallery['featured_on_homepage'] ?? false)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-kg-50 text-kg-700">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Featured on homepage
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">Not featured</span>
                                @endif
                            </td>
                            <td>
                                <div class="ki-table-actions">
                                <button
                                    type="button"
                                    @click="openGalleryId === {{ $gallery['gallery_id'] }} ? openGalleryId = null : openGalleryId = {{ $gallery['gallery_id'] }}"
                                    class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-xs font-medium border border-gray-300 text-gray-700 hover:bg-gray-100 transition-colors duration-150"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10"></path>
                                    </svg>
                                    Manage
                                </button>
                                <button
                                    type="button"
                                    onclick="openUploadModalForGallery({{ $gallery['gallery_id'] }})"
                                    class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-xs font-medium bg-kb-100 text-white hover:bg-kb-200 shadow-sm transition-colors duration-150"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    Upload
                                </button>
                                <button
                                    type="button"
                                    onclick='editCategory({{ $gallery['gallery_id'] }}, @json($gallery['name']), @json($gallery['description'] ?? ''))'
                                    class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-medium bg-white border border-kb-100 text-kb-100 hover:bg-kb-50 transition-colors duration-150"
                                >
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    onclick="deleteCategory({{ $gallery['gallery_id'] }}, '{{ addslashes($gallery['name']) }}')"
                                    class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-medium bg-red-500 text-white hover:bg-red-600 transition-colors duration-150"
                                >
                                    Delete
                                </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Nested images table for this gallery -->
                        <tr x-show="openGalleryId === {{ $gallery['gallery_id'] }}" x-cloak>
                            <td colspan="4" class="bg-gray-50">
                                @if (count($gallery['photos']) === 0)
                                    <div class="py-6 text-center text-sm text-gray-500">
                                        No images in this gallery yet. Use "Upload Images" to add photos.
                                    </div>
                                @else
                                    <div class="mt-3 mx-4 mb-4 border border-gray-200 rounded-lg bg-white overflow-hidden">
                                        <div class="ki-toolbar px-4 py-3 border-b border-gray-200 bg-gray-50">
                                            <div class="ki-toolbar-start">
                                                <label class="inline-flex items-center gap-2 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    <input type="checkbox"
                                                           class="h-4 w-4 text-kb-100 border-gray-300 rounded"
                                                           data-gallery-select-all="{{ $gallery['gallery_id'] }}">
                                                    <span>Images in "{{ $gallery['name'] }}"</span>
                                                </label>
                                            </div>
                                            <div class="ki-toolbar-end">
                                                <span class="text-xs text-gray-500">
                                                    {{ count($gallery['photos']) }} total
                                                </span>
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-medium bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 transition-colors duration-150"
                                                    onclick="deleteSelectedPhotos({{ $gallery['gallery_id'] }})"
                                                >
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete Selected
                                                </button>
                                            </div>
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200 text-xs">
                                                <thead class="bg-white">
                                                    <tr>
                                                        <th class="px-4 py-2 text-left font-semibold text-gray-700 w-10">
                                                            <input type="checkbox"
                                                                   class="h-4 w-4 text-kb-100 border-gray-300 rounded"
                                                                   data-gallery-select-all="{{ $gallery['gallery_id'] }}">
                                                        </th>
                                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Preview</th>
                                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">File</th>
                                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Description</th>
                                                        <th class="px-4 py-2 text-right font-semibold text-gray-700">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-100">
                                                    @foreach ($gallery['photos'] as $photo)
                                                        <tr data-photo-row data-gallery-id="{{ $gallery['gallery_id'] }}">
                                                            <td class="px-4 py-2">
                                                                <input type="checkbox"
                                                                       class="h-4 w-4 text-kb-100 border-gray-300 rounded align-middle"
                                                                       data-photo-checkbox="{{ $gallery['gallery_id'] }}"
                                                                       value="{{ $photo['id'] ?? '' }}">
                                                            </td>
                                                            <td class="px-4 py-2">
                                                                @if(isset($photo['path']))
                                                                    @php
                                                                        // Use asset() directly like carousel does
                                                                        // Path is already "images/gallery/..." or "gallery/..."
                                                                        // If it starts with "images/", use as-is; otherwise add "storage/" prefix
                                                                        if (strpos($photo['path'], 'images/') === 0) {
                                                                            $imageUrl = asset($photo['path']);
                                                                        } else {
                                                                            // Legacy: convert "gallery/..." to "images/gallery/..." for old records
                                                                            $imagePath = str_replace('gallery/', 'images/gallery/', $photo['path']);
                                                                            $imageUrl = asset($imagePath);
                                                                        }
                                                                    @endphp
                                                                    <img src="{{ $imageUrl }}"
                                                                         alt="Gallery Image {{ $photo['id'] ?? '' }}"
                                                                         class="h-12 w-16 object-cover rounded border border-gray-200"
                                                                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'64\' height=\'48\'%3E%3Crect fill=\'%23e5e7eb\' width=\'64\' height=\'48\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%239ca3af\' font-family=\'sans-serif\' font-size=\'10\'%3ENo Image%3C/text%3E%3C/svg%3E';">
                                                                @else
                                                                    <div class="h-12 w-16 flex items-center justify-center rounded border border-dashed border-gray-300 bg-gray-50">
                                                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td class="px-4 py-2">
                                                                <div class="text-xs font-medium text-gray-900">
                                                                    {{ basename($photo['path'] ?? '') }}
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-2">
                                                                <div class="text-xs text-gray-600">
                                                                    {{ \Illuminate\Support\Str::limit($photo['description'] ?? '', 80) }}
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-2 text-right">
                                                                <button
                                                                    type="button"
                                                                    onclick="deletePhoto({{ $photo['id'] ?? 0 }}, event)"
                                                                    class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-red-500 text-white hover:bg-red-600 transition-colors duration-150"
                                                                >
                                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                    </svg>
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12 px-6">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No galleries found</h3>
            <p class="mt-1 text-sm text-gray-500">Create a category and start uploading images.</p>
        </div>
    @endif
</div>

<script>
function deletePhoto(photoId, event) {
    if (!photoId || photoId <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Invalid photo ID',
            confirmButtonColor: '#183ea4'
        });
        return;
    }
    
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
    // Show loading state
    let deleteBtn = null;
    if (event && event.target) {
        deleteBtn = event.target.closest('button');
    } else if (event && event.currentTarget) {
        deleteBtn = event.currentTarget;
    } else if (window.event && window.event.target) {
        deleteBtn = window.event.target.closest('button');
    }
    
    const originalHTML = deleteBtn ? deleteBtn.innerHTML : '';
    if (deleteBtn) {
        deleteBtn.innerHTML = '<svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        deleteBtn.disabled = true;
    }
    
    const deleteUrl = `{{ url('dashboard/gallery/delete') }}/${photoId}`;
    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Delete failed');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Image has been deleted.',
                        confirmButtonColor: '#183ea4',
                        timer: 1500,
                        showConfirmButton: false
                    });
            // Remove the image from the DOM (table row or old grid card)
            if (deleteBtn) {
                const imageContainer = deleteBtn.closest('tr[data-photo-row], .mb-4, .group');
                if (imageContainer) {
                    imageContainer.style.transition = 'opacity 0.3s';
                    imageContainer.style.opacity = '0';
                    setTimeout(() => {
                        imageContainer.remove();
                        // Reload page to refresh gallery counts
                        location.reload();
                    }, 300);
                    return;
                }
            }
            // Fallback: reload page
                    setTimeout(() => location.reload(), 1500);
        } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to delete image',
                        confirmButtonColor: '#183ea4'
                    });
            if (deleteBtn) {
                deleteBtn.innerHTML = originalHTML;
                deleteBtn.disabled = false;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Failed to delete image',
                    confirmButtonColor: '#183ea4'
                });
        if (deleteBtn) {
            deleteBtn.innerHTML = originalHTML;
            deleteBtn.disabled = false;
                }
            });
        }
    });
}

function editCategory(id, name, description) {
    Swal.fire({
        title: 'Edit Category',
        html: `
            <input id="swal-edit-category-name" class="swal2-input" placeholder="Category name" value="${name.replace(/"/g, '&quot;')}" required>
            <textarea id="swal-edit-category-description" class="swal2-textarea" placeholder="Description (optional)">${(description || '').replace(/</g, '&lt;').replace(/>/g, '&gt;')}</textarea>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Update Category',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#183ea4',
        preConfirm: () => {
            const newName = document.getElementById('swal-edit-category-name').value.trim();
            const newDescription = document.getElementById('swal-edit-category-description').value.trim();
            
            if (!newName) {
                Swal.showValidationMessage('Category name is required');
                return false;
            }
            
            if (newName === name && newDescription === (description || '')) {
                Swal.showValidationMessage('No changes made');
                return false;
            }
            
            return { name: newName, description: newDescription };
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            const { name: newName, description: newDescription } = result.value;
            
            fetch(`/dashboard/gallery/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    name: newName,
                    description: newDescription
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category updated successfully',
                        confirmButtonColor: '#183ea4'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to update category',
                        confirmButtonColor: '#183ea4'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update category',
                    confirmButtonColor: '#183ea4'
                });
            });
        }
    });
}

function deleteCategory(id, name) {
    Swal.fire({
        title: 'Are you sure?',
        html: `You are about to delete the category "<strong>${name.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</strong>".<br><br>This will delete <strong>ALL photos</strong> in this category.<br><br>This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/dashboard/gallery/category/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Category has been deleted.',
                        confirmButtonColor: '#183ea4'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to delete category',
                        confirmButtonColor: '#183ea4'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete category',
                    confirmButtonColor: '#183ea4'
                });
            });
        }
    });
}

// Handle "select all" per gallery
document.addEventListener('change', function(e) {
    const target = e.target;
    const galleryId = target.getAttribute('data-gallery-select-all');
    if (!galleryId) return;

    const isChecked = target.checked;
    const checkboxes = document.querySelectorAll('[data-photo-checkbox="' + galleryId + '"]');
    checkboxes.forEach(cb => {
        cb.checked = isChecked;
    });
});

// Bulk delete selected photos in a gallery
function deleteSelectedPhotos(galleryId) {
    const checkboxes = document.querySelectorAll('[data-photo-checkbox="' + galleryId + '"]:checked');
    if (!checkboxes.length) {
        Swal.fire({
            icon: 'info',
            title: 'No images selected',
            text: 'Please select one or more images to delete.',
            confirmButtonColor: '#183ea4'
        });
        return;
    }

    const ids = Array.from(checkboxes)
        .map(cb => cb.value)
        .filter(Boolean);

    Swal.fire({
        title: 'Delete selected images?',
        html: `You are about to delete <strong>${ids.length}</strong> image(s). This cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete them',
        cancelButtonText: 'Cancel'
    }).then(result => {
        if (!result.isConfirmed) {
            return;
        }

        fetch('{{ route('dashboard.gallery.deleteSelected') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ ids })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted',
                    text: data.message || 'Selected images have been deleted.',
                    confirmButtonColor: '#183ea4',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to delete selected images.',
                    confirmButtonColor: '#183ea4'
                });
            }
        })
        .catch(error => {
            console.error('Bulk delete error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while deleting images.',
                confirmButtonColor: '#183ea4'
            });
        });
    });
}
</script>