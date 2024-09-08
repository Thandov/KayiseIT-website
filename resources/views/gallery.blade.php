<x-app-layout>
    <div x-data="{openTab: 'TVET Placement 2022 - 2023', lightbox: false, selectedImageIndex: null, images: [], openLightbox(index, images) { this.lightbox = true; this.selectedImageIndex = index; this.images = images.map(image => ({...image, path: '../' + image.path })); }, nextImage() { this.selectedImageIndex = (this.selectedImageIndex + 1) % this.images.length; }, prevImage() { this.selectedImageIndex = (this.selectedImageIndex - 1 + this.images.length) % this.images.length; } }">
        <div class="grid grid-cols-10 p-6 bg-red-100">
            <!-- Tabs -->
            <div class="col-span-3">
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

                <!-- Individual Galleries Tab Panes -->
                @if (!empty($galleries))
                @foreach ($galleries as $gallery)
                <div class="p-4 bg-gray-50 rounded-lg" x-show="openTab === '{{ $gallery['name'] }}'">
                    <h3>{{$gallery['name']}}</h3>
                    <div class="owl-carousel gallCal">
                        @foreach ($gallery['photos'] as $index => $photo)
                        <div class="h-55 h-60"
                            style="background-image: url('{{ asset($photo['path']) }}'); background-size: cover; background-position: center"
                            data-dot="<img src='{{ asset($photo['path']) }}' alt='Thumbnail {{ $index + 1 }}' class='thumbnail-dot'>">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>

    </div>

</x-app-layout>