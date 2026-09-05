    <a href="{{ $href }}" class="dashcard group relative overflow-hidden bg-white rounded-lg hover:bg-[#f6f8fc] transition-colors duration-200 border border-gray-200 hover:border-[#183ea4]">
        <div class="p-4 text-center">
            @if(isset($icon))
            <div class="text-2xl mb-2">
                {{ $icon }}
            </div>
            @endif
            <div class="text-sm font-medium text-gray-700 group-hover:text-[#183ea4] transition-colors duration-200">
                {{ $name }}
            </div>
        </div>
    </a>