<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        @php $archivedCount = $archivedCount ?? 0; @endphp
        <div class="ki-toolbar mb-6">
            <div class="ki-toolbar-start">
                <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Announcement Management</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage announcements displayed on the homepage. Expired items move to the JSON archive.</p>
                </div>
            </div>
            <div class="ki-toolbar-end">
                <a href="{{ route('admin.dashboard.announcements.archive') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    View archive{{ $archivedCount > 0 ? ' (' . $archivedCount . ')' : '' }}
                </a>
                <form action="{{ route('admin.dashboard.announcements.archive.run') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            onclick="return confirm('Move expired announcements to JSON?')">
                        Archive now
                    </button>
                </form>
                <a href="{{ route('admin.dashboard.announcements.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Announcement
                </a>
            </div>
        </div>

        <!-- Announcements Content with Grid Layout -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 items-stretch">
            @include('admin.dashboard.announcements._partial', ['announcements' => $announcements])
        </div>
        
        <!-- Empty State -->
        @if($announcements->isEmpty())
        <div class="text-center py-12">
            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No announcements found</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first announcement.</p>
            <a href="{{ route('admin.dashboard.announcements.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Announcement
            </a>
        </div>
        @endif

        <!-- Pagination -->
        @if($announcements->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-1">
                @if($announcements->previousPageUrl())
                <a href="{{ $announcements->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                @endif

                @foreach(range(1, $announcements->lastPage()) as $page)
                    @if($page == $announcements->currentPage())
                           <span class="px-3 py-2 text-sm font-medium text-white bg-green-600 border border-green-600 rounded transition-colors duration-200">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $announcements->url($page) }}" 
                       class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach

                @if($announcements->nextPageUrl())
                <a href="{{ $announcements->nextPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endif
            </nav>
        </div>
        @endif

        <!-- Summary stats -->
        @if($announcements->count() > 0)
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Total announcements: <strong>{{ $announcements->total() }}</strong></span>
                @if($announcements->currentPage() != 1 || $announcements->hasMorePages())
                <span>Page {{ $announcements->currentPage() }} of {{ $announcements->lastPage() }}</span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>









