<!-- partials.carousels.blade.php -->
@foreach ($carousels as $carousel)
<div class="caraslide max-w-md py-4 px-4 bg-white shadow-lg rounded-lg mb-4 relative group overflow-hidden" style="background-image: url('{{ asset($carousel->image) }}'); height: 250px; background-position: center; background-size:cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg"></div>
    
    <!-- Action buttons overlay -->
    <div class="absolute top-2 right-2 z-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        <div class="flex space-x-1">
            <a href="{{ route('admin.dashboard.carousel.show', $carousel->id) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
               title="View">
                <i class="fas fa-eye text-xs"></i>
            </a>
            <a href="{{ route('admin.dashboard.carousel.edit', $carousel->id) }}" 
               class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
               title="Edit">
                <i class="fas fa-edit text-xs"></i>
            </a>
            <form action="{{ route('admin.dashboard.carousel.destroy', $carousel->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
                        title="Delete"
                        onclick="return confirm('Are you sure you want to delete this carousel?')">
                    <i class="fas fa-trash text-xs"></i>
                </button>
            </form>
        </div>
    </div>
    
    <a href="{{ route('admin.dashboard.carousel.show', $carousel->id) }}">
        <div class="rounded-lg h-full flex flex-col justify-center items-start absolute p-4 z-40 inset-0">
            <p class="text-white text-lg font-semibold mb-2">{{$carousel->title ?? ''}}</p>
            <p class="text-white text-base font-medium mb-1">{{$carousel->middletxt ?? ''}}</p>
            <p class="text-white text-sm">{{$carousel->btmtxt ?? ''}}</p>
        </div>
    </a>
</div>
@endforeach