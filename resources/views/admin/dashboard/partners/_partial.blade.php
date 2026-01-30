@foreach ($partners as $partner)
<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 group hover:shadow-lg transition-shadow duration-200">
    <div class="p-4">
        <!-- Partner Logo -->
        <div class="mb-4 h-32 flex items-center justify-center bg-gray-50 rounded-lg">
            @if($partner->logo_path)
                <img src="{{ asset($partner->logo_path) }}" 
                     alt="{{ $partner->name }}" 
                     class="max-h-24 max-w-full object-contain">
            @else
                <div class="text-gray-400">
                    <i class="fas fa-image text-4xl"></i>
                </div>
            @endif
        </div>
        
        <!-- Partner Info -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1 line-clamp-2">{{ $partner->name }}</h3>
            @if($partner->description)
                <p class="text-sm text-gray-600 line-clamp-2">{{ $partner->description }}</p>
            @endif
            @if($partner->website_url)
                <a href="{{ $partner->website_url }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 mt-1 inline-block">
                    <i class="fas fa-external-link-alt mr-1"></i>Visit Website
                </a>
            @endif
        </div>
        
        <!-- Status Badge -->
        <div class="mb-4">
            @if($partner->is_active)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>Active
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    <i class="fas fa-times-circle mr-1"></i>Inactive
                </span>
            @endif
            <span class="ml-2 text-xs text-gray-500">Order: {{ $partner->display_order }}</span>
        </div>
    </div>
    
    <!-- Action buttons -->
    <div class="px-4 pb-4 flex space-x-2">
        <a href="{{ route('dashboard.partners.edit', $partner->id) }}" 
           class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center py-2 px-3 rounded-md text-sm font-medium transition-colors duration-200"
           title="Edit">
            <i class="fas fa-edit mr-1"></i>Edit
        </a>
        <form action="{{ route('dashboard.partners.delete', $partner->id) }}" method="POST" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-md text-sm font-medium transition-colors duration-200"
                    title="Delete"
                    onclick="return confirm('Are you sure you want to delete this partner?')">
                <i class="fas fa-trash mr-1"></i>Delete
            </button>
        </form>
    </div>
</div>
@endforeach
