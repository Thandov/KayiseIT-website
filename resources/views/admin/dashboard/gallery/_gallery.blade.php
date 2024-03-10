<div x-data="{openTab: 'all', lightbox: false, selectedImageIndex: null, images: [], openLightbox(index, images) { this.lightbox = true; this.selectedImageIndex = index; this.images = images.map(image => ({...image, path: '../' + image.path })); }, nextImage() { this.selectedImageIndex = (this.selectedImageIndex + 1) % this.images.length; }, prevImage() { this.selectedImageIndex = (this.selectedImageIndex - 1 + this.images.length) % this.images.length; } }">
    <div class="grid grid-cols-10">
        <!-- Tabs -->
        <div class="col-span-3">
            <button class="block p-2 border-b-2 border-transparent hover:border-gray-300 hover:bg-gray-100" :class="{ 'border-blue-500 text-blue-600': openTab === 'all' }" @click="openTab = 'all'" type="button">All</button>
            @if (!empty($galleries))
            @foreach ($galleries as $gallery)
            <button class="block p-2 border-b-2 border-transparent hover:border-gray-300 hover:bg-gray-100" :class="{ 'border-blue-500 text-blue-600': openTab === '{{ $gallery['name'] }}' }" @click="openTab = '{{ $gallery['name'] }}'" type="button">{{ $gallery['name'] }}</button>
            @endforeach
            @endif
        </div>
        <!-- Tab Content -->
        <div class="col-span-7 tab-content">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <!-- All Galleries Tab Pane -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="openTab === 'all'">
                @if (!empty($galleries))
                @foreach ($galleries as $gallery)
                @foreach ($gallery['photos'] as $index => $photo)
                <div class="flex justify-center" @click="openLightbox({{ $index }}, {{ json_encode($gallery['photos']) }})">
                    <!-- The image component with the correct path -->
                    <x-img-card pic="../{{ $photo['path'] }}" picid="{{$photo->id}}" />
                </div>
                @endforeach
                @endforeach
                @endif
            </div>
            <!-- Individual Galleries Tab Panes -->
            @if (!empty($galleries))
            @foreach ($galleries as $gallery)
            <div class="p-4 bg-gray-50 rounded-lg grid grid-cols-1 md:grid-cols-2 gap-4" x-show="openTab === '{{ $gallery['name'] }}'">
                @foreach ($gallery['photos'] as $index => $photo)
                <div class="flex justify-center" @click="openLightbox({{ $index }}, {{ json_encode($gallery['photos']) }})">
                    <!-- The image component with the correct path -->
                    <x-img-card pic="../{{ $photo['path'] }}" picid="{{$photo->id}}" />
                </div>
                @endforeach
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <!-- Lightbox Overlay -->
    <div x-show="lightbox" class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50" x-on:click.self="lightbox = false">
        <div class="relative">
            <!-- Navigation Arrows -->
            <button class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white" @click.stop="prevImage()">&#10094;</button>
            <!-- The src attribute is bound to a constructed path using Alpine.js -->
            <img :src="'../' + images[selectedImageIndex].path" class="max-w-full max-h-full" />
            <button class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white" @click.stop="nextImage()">&#10095;</button>

            <!-- Clickable overlay to close the lightbox -->
            <div class="absolute top-0 left-0 w-full h-full" @click="lightbox = false"></div>
        </div>
    </div>
</div>