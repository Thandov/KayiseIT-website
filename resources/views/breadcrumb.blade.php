@php
$url = '/';
$segments = explode('/', request()->path());
$segmentCount = count($segments);
@endphp

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
        <div class="p-6 bg-white border-b border-gray-200">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">

                    <li class="inline-flex items-center">
                        <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium inline-flex">
                            Dashboard
                        </a>
                    </li>

                    @foreach($segments as $index => $segment)
                    @php
                    $url .= $segment . '/';
                    @endphp

                    @if ($segment !== 'dashboard') <!-- Ignore 'dashboard' segment -->
                    @if ($index > 0) <!-- Skip adding ">" before the first segment other than 'dashboard' -->
                    <li class="inline-flex items-center">
                        <svg class="ml-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    @endif

                    @if ($index === $segmentCount - 1) <!-- Last segment, no link -->
                    <li aria-current="page" class="text-sm font-medium text-gray-700 inline-flex items-center">
                        {{ ucfirst($segment) }}
                    </li>
                    @else <!-- Other segments with links -->
                    <li class="inline-flex items-center">
                        <a href="{{ url($url) }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            {{ ucfirst($segment) }}
                        </a>
                    </li>
                    @endif
                    @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
