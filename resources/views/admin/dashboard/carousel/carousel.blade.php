<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-kb-100 rounded-md p-3">
                <i class="fas fa-cogs text-white"></i>
            </div>
            <!-- CSS Test Element -->
            <div class="ml-4 bg-red-500 text-white px-4 py-2 rounded-lg">
                🎨 CSS Working! Tailwind is loaded correctly.
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Carousel Management</h3>
                    </dt>
                    <dd>
                        <div class="text-lg font-medium text-gray-900">
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage carousel slides for the homepage.</p>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="ml-auto space-x-2">
                <x-front-end-btn linking="{{ route('admin.dashboard.carousel.create') }}" color="blue" showme="add-service-btn" name="Add Carousel" />
            </div>
        </div>

        <!-- Carousel Content with Grid Layout -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @include('admin.dashboard.carousel._partial', ['carousels' => $carousels])
        </div>
        
        <!-- Empty State -->
        @if($carousels->isEmpty())
        <div class="text-center py-12">
            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                <i class="fas fa-images text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No carousels found</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first carousel slide.</p>
                   <a href="{{ route('admin.dashboard.carousel.create') }}" 
                      class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-200 focus:bg-kb-200 active:bg-kb-300 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2"></i>
                Add Carousel
            </a>
        </div>
        @endif

        <!-- Pagination with better design -->
        @if($carousels->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-1">
                <!-- Previous page link -->
                @if($carousels->previousPageUrl())
                <a href="{{ $carousels->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                <!-- Page links -->
                @foreach(range(1, $carousels->lastPage()) as $page)
                    @if($page == $carousels->currentPage())
                           <span class="px-3 py-2 text-sm font-medium text-white bg-kb-100 border border-kb-100 rounded transition-colors duration-200">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $carousels->url($page) }}" 
                       class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach

                <!-- Next page link -->
                @if($carousels->nextPageUrl())
                <a href="{{ $carousels->nextPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @endif
            </nav>
        </div>
        @endif

        <!-- Summary stats -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Total carousels: <strong>{{ $carousels->total() }}</strong></span>
                @if($carousels->currentPage() != 1 || $carousels->hasMorePages())
                <span>Page {{ $carousels->currentPage() }} of {{ $carousels->lastPage() }}</span>
                @endif
            </div>
        </div>
    </div>
</div>