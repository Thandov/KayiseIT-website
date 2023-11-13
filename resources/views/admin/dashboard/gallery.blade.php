        <div class="mb-4 grid md:grid-cols-5 md:gap-4">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-3 border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Gallery</h3>
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All our memories.</p>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div x-data="{openTab: 'all', lightbox: false, selectedImageIndex: null, images: [], openLightbox(index, images) { this.lightbox = true; this.selectedImageIndex = index; this.images = images.map(image => ({...image, path: '../' + image.path })); }, nextImage() { this.selectedImageIndex = (this.selectedImageIndex + 1) % this.images.length; }, prevImage() { this.selectedImageIndex = (this.selectedImageIndex - 1 + this.images.length) % this.images.length; } }">
                    <!-- Tabs -->
                    <ul class="flex border-b border-gray-200">
                        <li class="mr-2">
                            <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:border-gray-300 hover:bg-gray-100" :class="{ 'border-blue-500 text-blue-600': openTab === 'all' }" @click="openTab = 'all'" type="button">All</button>
                        </li>
                        @if (!empty($galleries))
                        @foreach ($galleries as $gallery)
                        <li class="mr-2">
                            <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:border-gray-300 hover:bg-gray-100" :class="{ 'border-blue-500 text-blue-600': openTab === '{{ $gallery['name'] }}' }" @click="openTab = '{{ $gallery['name'] }}'" type="button">{{ $gallery['name'] }}</button>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- All Galleries Tab Pane -->
                        <div class="p-4 bg-gray-50 rounded-lg grid grid-cols-4 gap-4" x-show="openTab === 'all'">
                            @if (!empty($galleries))
                            @foreach ($galleries as $gallery)
                            @foreach ($gallery['photos'] as $index => $photo)
                            <div @click="openLightbox({{ $index }}, {{ json_encode($gallery['photos']) }})">
                                <!-- The image component with the correct path -->
                                <x-img-card pic="../{{ $photo['path'] }}" />
                            </div>
                            @endforeach
                            @endforeach
                            @endif
                        </div>
                        <!-- Individual Galleries Tab Panes -->
                        @if (!empty($galleries))
                        @foreach ($galleries as $gallery)
                        <div class="p-4 bg-gray-50 rounded-lg grid grid-cols-4 gap-4" x-show="openTab === '{{ $gallery['name'] }}'">
                            @foreach ($gallery['photos'] as $index => $photo)
                            <div @click="openLightbox({{ $index }}, {{ json_encode($gallery['photos']) }})">
                                <!-- The image component with the correct path -->
                                <x-img-card pic="../{{ $photo['path'] }}" />
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                        @endif
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
            </div>
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-2 border-b border-gray-200">
                @include('admin.dashboard.gallery._upload')
            </div>
        </div>