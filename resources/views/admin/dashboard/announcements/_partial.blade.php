@foreach ($announcements as $announcement)
<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group relative h-full flex flex-col">
    <!-- Image Section -->
    @if($announcement->image)
        <div class="relative h-48 overflow-hidden bg-[#f0f4ff]">
            <img src="{{ asset($announcement->image) }}" 
                 alt="{{ $announcement->title ?? 'Announcement' }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            @if($announcement->badge)
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                          style="background: #16A34A; border: 1px solid #16A34A; color: #fff;">
                        {{ $announcement->badge }}
                    </span>
                </div>
            @endif
        </div>
    @else
        <!-- Placeholder -->
        <div class="relative h-48 overflow-hidden bg-[#263a57]">
            @if($announcement->badge)
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                          style="background: #16A34A; border: 1px solid #16A34A; color: #fff;">
                        {{ $announcement->badge }}
                    </span>
                </div>
            @endif
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
        </div>
    @endif
    
    <!-- Action buttons overlay -->
    <div class="absolute top-2 right-2 z-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200" onclick="event.stopPropagation();">
        <div class="flex space-x-1">
            <a href="{{ route('admin.dashboard.announcements.show', $announcement->id) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
               title="View Details">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </a>
            <a href="{{ route('admin.dashboard.announcements.edit', $announcement->id) }}" 
               class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
               title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </a>
            <form action="{{ route('admin.dashboard.announcements.destroy', $announcement->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
                        title="Delete"
                        onclick="return confirm('Are you sure you want to delete this announcement?')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Content Section -->
    <a href="{{ route('admin.dashboard.announcements.show', $announcement->id) }}" class="flex flex-col flex-grow">
    <div class="p-6 flex flex-col flex-grow">
        <!-- Status Badge -->
        @if($announcement->expires_at)
            @if($announcement->expires_at->isPast())
                <div class="mb-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        EXPIRED
                    </span>
                </div>
            @elseif($announcement->expires_at->isToday())
                <div class="mb-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Expires Today
                    </span>
                </div>
            @elseif($announcement->expires_at->diffInDays(now()) <= 3)
                <div class="mb-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Expires {{ $announcement->expires_at->diffForHumans() }}
                    </span>
                </div>
            @endif
        @endif
        
        <!-- Date -->
        @if($announcement->created_at)
            <p class="text-xs text-gray-500 mb-2">
                Created: {{ $announcement->created_at->format('M d, Y') }}
                @if($announcement->expires_at)
                    <br>Expires: {{ $announcement->expires_at->format('M d, Y g:i A') }}
                @endif
            </p>
        @endif
        
        <!-- Title -->
        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-200">
            {{ $announcement->title ?? 'Announcement' }}
        </h3>
        
        <!-- Description -->
        @if($announcement->description)
            <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                {{ Str::limit($announcement->description, 120) }}
            </p>
        @endif
        
        <!-- External Link Button (if exists) -->
        @if($announcement->link)
            <div class="mt-auto pt-4 border-t border-gray-200" onclick="event.stopPropagation(); window.open('{{ $announcement->link }}', '{{ (strpos($announcement->link, 'http') === 0) ? '_blank' : '_self' }}');">
                <div class="inline-flex items-center text-sm font-semibold transition-colors duration-200 hover:text-green-700"
                     style="color: #22C55E;">
                    <span>Visit External Link</span>
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </div>
            </div>
        @endif
    </div>
    </a>
</div>
@endforeach

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>









