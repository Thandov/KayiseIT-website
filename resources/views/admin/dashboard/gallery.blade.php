<div class="ki-stack">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="ki-cluster">
            <svg class="w-5 h-5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="ki-cluster">
            <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="ki-panel ki-panel-accent">
        <div class="ki-toolbar">
            <div class="ki-toolbar-start">
                <div class="bg-kb-100 rounded-lg p-3 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <div class="min-w-0 max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-900">Featured Gallery on Homepage</h3>
                    <p class="text-sm text-gray-600 mt-1">Select which gallery appears on the homepage. The gallery name and description (edit via Gallery → Edit) are shown as the section heading and text.</p>
                </div>
            </div>
            <div class="ki-toolbar-end">
                @php
                    $featuredGallery = \App\Models\Gallery::where('featured_on_homepage', true)->first();
                @endphp
                @if($featuredGallery)
                    <div class="bg-white rounded-lg px-4 py-2 border border-kb-300">
                        <span class="text-sm font-medium text-gray-700">Current: </span>
                        <span class="text-sm font-bold text-kb-100">{{ $featuredGallery->name }}</span>
                    </div>
                @else
                    <div class="bg-white rounded-lg px-4 py-2 border border-gray-300">
                        <span class="text-sm text-gray-500">No gallery selected</span>
                    </div>
                @endif
                <select id="featured-gallery-select" class="min-w-[14rem] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kb-100 focus:border-kb-100 text-sm">
                    <option value="">-- Select Gallery --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($category->featured_on_homepage ?? false) ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->photos->count() }} photos)
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @if($featuredGallery)
        <div class="mt-6 pt-6 border-t border-kb-200">
            <p class="text-sm font-medium text-gray-700 mb-2">Homepage preview</p>
            <div class="bg-white rounded-lg px-4 py-3 border border-kb-300">
                <p class="text-lg font-bold text-gray-900">{{ $featuredGallery->name }}</p>
                @if($featuredGallery->description)
                <p class="text-sm text-gray-600 mt-1 whitespace-pre-line">{{ $featuredGallery->description }}</p>
                @else
                <p class="text-sm text-gray-400 mt-1 italic">No description — add one when editing this gallery.</p>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="ki-panel-muted">
        <div class="ki-toolbar">
            <div class="ki-toolbar-start">
                <div class="bg-kb-100 rounded-lg p-3 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Gallery Actions</h3>
                    <p class="text-sm text-gray-600 mt-1">Manage your image collection</p>
                </div>
            </div>
            <div class="ki-toolbar-end">
                <button onclick="openUploadModal(false)" class="inline-flex items-center px-4 py-2.5 bg-kb-100 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Images
                </button>
                <button onclick="openUploadModal(true)" class="inline-flex items-center px-4 py-2.5 bg-kg-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-kg-600 focus:outline-none focus:ring-2 focus:ring-kg-700 focus:ring-offset-2 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Category & Upload
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="border-b border-gray-200">
            <nav class="flex gap-8 px-6">
                <button onclick="showTab('all')" class="tab-btn py-4 px-1 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200" data-tab="all">
                    <div class="ki-cluster">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        All Images
                    </div>
                </button>
                <button onclick="showTab('categories')" class="tab-btn py-4 px-1 border-b-2 font-medium text-sm focus:outline-none transition-all duration-200" data-tab="categories">
                    <div class="ki-cluster">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Categories
                    </div>
                </button>
            </nav>
        </div>

        <!-- Gallery Content -->
        <div id="gallery-content">
            @include('admin.dashboard.gallery._gallery')
        </div>
    </div>
    
    <!-- Upload Modal -->
    <div id="upload-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-[70%] max-w-6xl mx-4 my-8">
            @include('admin.dashboard.gallery._upload', ['categories' => $categories ?? collect()])
        </div>
    </div>
</div>

<script>
// Gallery Management Functions - Version 2.0 (No prompt() calls)
// Ensure SweetAlert2 is loaded before using these functions
document.addEventListener('DOMContentLoaded', function() {
    // Wait for SweetAlert2 to be available
    if (typeof Swal === 'undefined') {
        console.warn('SweetAlert2 not loaded yet, waiting...');
        setTimeout(function() {
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 failed to load');
            }
        }, 1000);
    }
});

function showTab(tab) {
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(t => {
        t.classList.remove('border-kb-100', 'text-kb-100');
        t.classList.add('border-transparent', 'text-gray-500');
    });
    
    const activeTab = document.querySelector(`[data-tab="${tab}"]`);
    if (activeTab) {
        activeTab.classList.add('border-kb-100', 'text-kb-100');
        activeTab.classList.remove('border-transparent', 'text-gray-500');
    }
    
    // Update Alpine.js openTab state via event
    window.dispatchEvent(new CustomEvent('gallery-tab-change', { detail: { tab: tab } }));
}

function openUploadModal(preSelectNewCategory = false) {
    const modal = document.getElementById('upload-modal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // If preSelectNewCategory is true, select "Create new category" option
        setTimeout(() => {
            const categorySelect = document.getElementById('category');
            if (!categorySelect) return;

            if (preSelectNewCategory) {
                categorySelect.value = 'add_cat';
            } else {
                categorySelect.value = '';
            }
            categorySelect.dispatchEvent(new Event('change'));
        }, 100);
    }
}

// Open upload modal for a specific gallery (pre-selects the category)
function openUploadModalForGallery(galleryId) {
    const modal = document.getElementById('upload-modal');
    if (!modal) return;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        const categorySelect = document.getElementById('category');
        const newCategoryContainer = document.getElementById('newCategoryContainer');

        if (categorySelect) {
            categorySelect.value = String(galleryId);
            categorySelect.dispatchEvent(new Event('change'));
        }

        if (newCategoryContainer) {
            newCategoryContainer.style.maxHeight = '0';
            newCategoryContainer.style.display = 'none';
        }
    }, 100);
}

// Make function globally available
window.addCategory = function(event) {
    // Ensure SweetAlert2 is loaded
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 is not loaded. Please refresh the page.');
        alert('Please refresh the page to use this feature.');
        return;
    }
    
    Swal.fire({
        title: 'Add New Category',
        html: `
            <input id="swal-category-name" class="swal2-input" placeholder="Category name" required>
            <textarea id="swal-category-description" class="swal2-textarea" placeholder="Description (optional)"></textarea>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Create Category',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#183ea4',
        preConfirm: () => {
            const name = document.getElementById('swal-category-name').value.trim();
            const description = document.getElementById('swal-category-description').value.trim();
            
            if (!name) {
                Swal.showValidationMessage('Category name is required');
                return false;
            }
            
            return { name, description };
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            const { name, description } = result.value;
            
            // Show loading state
            const button = event ? event.target.closest('button') : document.querySelector('button[onclick*="addCategory"]');
            const originalText = button ? button.innerHTML : '';
            
            if (button) {
                button.disabled = true;
                button.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Creating...';
            }
            
            // Make AJAX request to add category
            fetch('{{ route("dashboard.gallery.category.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    name: name,
                    description: description
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category created successfully! You can now upload images to this category.',
                        confirmButtonColor: '#183ea4'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to create category',
                        confirmButtonColor: '#183ea4'
                    });
                    if (button) {
                        button.disabled = false;
                        button.innerHTML = originalText;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An error occurred while creating the category. Please try again.',
                    confirmButtonColor: '#183ea4'
                });
                if (button) {
                    button.disabled = false;
                    button.innerHTML = originalText;
    }
            });
        }
    });
};

// Enhanced modal closing functionality
document.addEventListener('DOMContentLoaded', function() {
    const uploadModal = document.getElementById('upload-modal');
    if (uploadModal) {
        // Close modal when clicking outside
        uploadModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                this.classList.remove('flex');
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                uploadModal.classList.add('hidden');
                uploadModal.classList.remove('flex');
            }
        });
    }
    
    // Featured Gallery Selection - moved here to avoid conflicts
    const featuredSelect = document.getElementById('featured-gallery-select');
    if (featuredSelect) {
        featuredSelect.addEventListener('change', function() {
            const galleryId = this.value;
            if (!galleryId) {
                return;
            }
            
            // Show loading state
            const originalValue = this.value;
            this.disabled = true;
            const originalHTML = this.innerHTML;
            this.innerHTML = '<option>Setting featured gallery...</option>';
            
            // Make API call
            fetch(`/dashboard/gallery/${galleryId}/set-featured`, {
                method: 'POST',
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
                    // Reload page to show updated featured gallery
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to set featured gallery',
                        confirmButtonColor: '#183ea4'
                    });
                    this.value = originalValue;
                    this.disabled = false;
                    this.innerHTML = originalHTML;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to set featured gallery',
                    confirmButtonColor: '#183ea4'
                });
                this.value = originalValue;
                this.disabled = false;
                this.innerHTML = originalHTML;
            });
        });
    }
});
</script>

<style>
/* Additional CSS for enhanced animations and transitions */
.gallery-hover-scale {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-hover-scale:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Button solid fill */
.button-gradient {
    background: #183ea4;
    transition: background-color 0.2s ease;
}

.button-gradient:hover {
    background: #263a57;
}

/* Smooth tab transitions */
.tab-content {
    transition: opacity 0.2s ease-in-out;
}

/* Enhanced lightbox backdrop */
.backdrop-blur {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* Ensure gallery grid responsiveness */
.masonry-grid {
    column-gap: 1rem;
}

@media (max-width: 768px) {
    .masonry-grid {
        columns: 1;
    }
}

@media (min-width: 769px) {
    .masonry-grid {
        columns: 2;
    }
}

@media (min-width: 1024px) {
    .masonry-grid {
        columns: 3;
    }
}

@media (min-width: 1280px) {
    .masonry-grid {
        columns: 4;
    }
}
</style>
