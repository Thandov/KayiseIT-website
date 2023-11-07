<x-app-layout title="Staff Dashboard">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('breadcrumb')
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
                <div x-data="{ openTab: 'all' }">
                    <!-- Tabs -->
                    <ul class="flex border-b border-gray-200">
                        <li class="mr-2">
                            <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:border-gray-300 hover:bg-gray-100" :class="{ 'border-blue-500 text-blue-600': openTab === 'all' }" @click="openTab = 'all'" type="button">All</button>
                        </li>
                        @foreach ($galleries as $gallery)
                        <li class="mr-2">
                            <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:border-gray-300 hover:bg-gray-100" :class="{ 'border-blue-500 text-blue-600': openTab === '{{ $gallery['name'] }}' }" @click="openTab = '{{ $gallery['name'] }}'" type="button">{{ $gallery['name'] }}</button>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- All Galleries Tab Pane -->
                        <div class="p-4 bg-gray-50 rounded-lg" x-show="openTab === 'all'">
                            @foreach ($galleries as $gallery)
                            @foreach ($gallery['photos'] as $photo)
                            <img class="inline-block w-full sm:w-1/2 md:w-1/4 lg:w-1/5 p-1" src="{{ asset($photo['path']) }}" alt="Photo">
                            @endforeach
                            @endforeach
                        </div>

                        <!-- Individual Galleries Tab Panes -->
                        @foreach ($galleries as $gallery)
                        <div class="p-4 bg-gray-50 rounded-lg" x-show="openTab === '{{ $gallery['name'] }}'">
                            @foreach ($gallery['photos'] as $photo)
                            <img class="inline-block w-full sm:w-1/2 md:w-1/4 lg:w-1/5 p-1" src="{{ asset($photo['path']) }}" alt="Photo">
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-2 border-b border-gray-200">
                @include('admin.dashboard.gallery._upload')
            </div>
        </div>
    </div>
</x-app-layout>