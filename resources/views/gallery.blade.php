<x-app-layout>
    <div x-data="{ 
        lightbox: false, 
        selectedImageIndex: null, 
        images: [], 
        selectedGallery: null, 
        activeGalleryId: null,
        init() {
            // Keyboard navigation for lightbox
            window.addEventListener('keydown', (e) => {
                if (this.lightbox) {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        this.prevImage();
                    } else if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        this.nextImage();
                    } else if (e.key === 'Escape') {
                        e.preventDefault();
                        this.lightbox = false;
                    }
                }
            });
        },
        openLightbox(galleryIndex, imageIndex) { 
            const galleries = {{ json_encode($galleries ?? []) }}; 
            if (galleries && galleries[galleryIndex] && galleries[galleryIndex].photos) {
                const gallery = galleries[galleryIndex]; 
                this.lightbox = true; 
                this.selectedImageIndex = imageIndex; 
                this.images = gallery.photos.map(photo => {
                    let path = photo.path || '';
                    // Path is already in format "images/gallery/..." - use directly
                    return {
                        ...photo, 
                        path: path ? '{{ asset('') }}' + path : '' 
                    };
                }); 
                this.selectedGallery = gallery; 
            }
        }, 
        nextImage() { 
            if (this.images && this.images.length > 0) {
                this.selectedImageIndex = (this.selectedImageIndex + 1) % this.images.length; 
            }
        }, 
        prevImage() { 
            if (this.images && this.images.length > 0) {
                this.selectedImageIndex = (this.selectedImageIndex - 1 + this.images.length) % this.images.length; 
            }
        },
        openGallery(galleryId) {
            this.activeGalleryId = this.activeGalleryId === galleryId ? null : galleryId;
        } 
    }">
        
        <!-- Hero Section -->
        <x-page-hero 
            title="Our Gallery" 
            subtitle="Capturing moments, creating memories"
            description="Explore our collection of memorable experiences and achievements"
            hero-id="gallery-hero-new"
            background-image="images/landing-page/banner3.png" />

        <!-- Error Message -->
        @if(session('error'))
        <div class="container mx-auto px-4 py-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Gallery Folders Section -->
        <div class="container mx-auto px-4 py-12">
            @if (!empty($galleries))
            <!-- Folders Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach ($galleries as $galleryIndex => $gallery)
                <div 
                    class="relative group cursor-pointer"
                    @click="openGallery({{ $gallery['gallery_id'] }})"
                    x-data="{ 
                        isActive: false,
                        init() {
                            this.$watch('$store.activeGalleryId', (value) => {
                                this.isActive = value === {{ $gallery['gallery_id'] }};
                            });
                        }
                    }"
                >
                    <!-- Folder Card with Cover Image -->
                    <div 
                        class="relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 h-64"
                        :class="{ 'ring-4 ring-green-400 ring-opacity-75': activeGalleryId === {{ $gallery['gallery_id'] }} }"
                    >
                        @if(!empty($gallery['photos']) && isset($gallery['photos'][0]))
                            <!-- Cover Image Background -->
                            <img 
                                src="{{ asset($gallery['photos'][0]['path']) }}" 
                                alt="{{ $gallery['name'] }} cover" 
                                class="absolute inset-0 w-full h-full object-cover"
                                loading="lazy"
                                onerror="this.onerror=null; this.style.display='none'; this.parentElement.classList.add('bg-gradient-to-br', 'from-blue-500', 'to-purple-600');"
                            >
                            <!-- Dark Overlay for Text Readability -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>
                        @else
                            <!-- Fallback Gradient if no images -->
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600"></div>
                        @endif
                        
                        <!-- Content Overlay -->
                        <div class="relative h-full flex flex-col justify-between p-6 text-white">
                            <!-- Folder Icon (only show if no image) -->
                            @if(empty($gallery['photos']) || !isset($gallery['photos'][0]))
                            <div class="flex items-center justify-center mb-4">
                                <svg class="w-16 h-16 text-white transform transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                </svg>
                            </div>
                            @endif
                            
                            <!-- Folder Info -->
                            <div class="mt-auto">
                                <h3 class="text-xl font-bold text-white mb-2 text-center drop-shadow-lg">{{ $gallery['name'] }}</h3>
                                @if(!empty($gallery['description']))
                                    <p class="text-white/90 text-sm text-center mb-3 line-clamp-2 drop-shadow">{{ $gallery['description'] }}</p>
                                @endif
                                <div class="flex items-center justify-center space-x-2 text-white/90 mb-3">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-semibold drop-shadow">{{ count($gallery['photos']) }} photos</span>
                                </div>
                                
                                <!-- Click Indicator -->
                                <div class="text-center">
                                    <span class="text-white/90 text-sm font-medium drop-shadow">Click to view</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Gallery Images Section (Shown when folder is clicked) -->
            @foreach ($galleries as $galleryIndex => $gallery)
            <div 
                x-show="activeGalleryId === {{ $gallery['gallery_id'] }}"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="mb-12"
            >
                    <!-- Gallery Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6 rounded-xl shadow-lg mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold mb-2">{{ $gallery['name'] }}</h2>
                        @if(!empty($gallery['description']))
                            <p class="text-blue-100 mb-2">{{ $gallery['description'] }}</p>
                        @endif
                        <p class="text-blue-100">{{ count($gallery['photos']) }} photos</p>
                        </div>
                        <button 
                            @click="activeGalleryId = null"
                            class="bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-300 transform hover:scale-110"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    </div>
                    
                <!-- Gallery Photos Grid with Stagger Animation -->
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                            @foreach ($gallery['photos'] as $index => $photo)
                    <div 
                        class="relative group cursor-pointer overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-110"
                        style="animation: fadeInUp 0.5s ease-out {{ $index * 0.05 }}s both;"
                        @click="openLightbox({{ $galleryIndex }}, {{ $index }})"
                    >
                        <img 
                            src="{{ asset($photo['path'] ?? '') }}" 
                                     alt="{{ $gallery['name'] }} - Photo {{ $index + 1 }}" 
                            class="w-full h-32 md:h-40 lg:h-48 object-cover transition-transform duration-500 group-hover:scale-125"
                            loading="lazy"
                            onerror="this.onerror=null; this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-32 md:h-40 lg:h-48 bg-gray-200 flex items-center justify-center rounded-lg\'><svg class=\'w-12 h-12 text-gray-400\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path fill-rule=\'evenodd\' d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\' clip-rule=\'evenodd\'></path></svg></div>'"
                        >
                                
                                <!-- Overlay effect -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end justify-center pb-4">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                        </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Number Badge -->
                        <div class="absolute top-2 right-2 bg-black/60 text-white text-xs font-semibold px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            {{ $index + 1 }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            
            @else
            <div class="text-center py-16 text-gray-500">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="mt-2 text-xl">No galleries available yet</p>
            </div>
            @endif
        </div>

        <!-- Lightbox Modal -->
        <div 
            x-show="lightbox" 
             x-transition:enter="transition-opacity duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4"
            x-on:click.self="lightbox = false"
            @keydown.escape.window="lightbox = false"
        >
            
            <div class="relative max-w-6xl max-h-full" 
                 x-transition:enter="transition-all duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">
                <!-- Close Button -->
                <button 
                    @click="lightbox = false" 
                    class="absolute top-4 right-4 z-10 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-all duration-300 transform hover:scale-110"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Navigation Buttons -->
                <button 
                    x-show="images.length > 1" 
                        @click="prevImage()"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all duration-300 transform hover:scale-110"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button 
                    x-show="images.length > 1"
                        @click="nextImage()"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all duration-300 transform hover:scale-110"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Main Image -->
                <div class="relative">
                    <img 
                        x-bind:src="(images && selectedImageIndex !== null && images[selectedImageIndex]) ? images[selectedImageIndex].path : ''" 
                         alt="Gallery Image" 
                        class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl"
                        x-transition:enter="transition-all duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                    >
                    
                    <!-- Image Counter -->
                    <div 
                        x-show="images && images.length > 1" 
                        class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm"
                    >
                        <span x-text="selectedImageIndex !== null ? selectedImageIndex + 1 : 0"></span> / <span x-text="images ? images.length : 0"></span>
                    </div>
                </div>

                <!-- Gallery Info -->
                <div x-show="selectedGallery" class="mt-4 text-center text-white">
                    <h3 x-text="selectedGallery?.name" class="text-xl font-semibold"></h3>
                    <p x-text="selectedGallery?.description" class="text-gray-300 mt-1" x-show="selectedGallery?.description"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Animations -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>
