    <a href="{{ $href }}" class="dashcard group relative overflow-hidden bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 border border-gray-200 hover:border-indigo-300">
        <div class="p-4 text-center">
            @if(isset($icon))
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform duration-300">
                {{ $icon }}
            </div>
            @endif
            <div class="text-sm font-medium text-gray-700 group-hover:text-indigo-600 transition-colors duration-300">
                {{ $name }}
            </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
    </a>