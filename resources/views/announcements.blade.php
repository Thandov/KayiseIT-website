<x-app-layout
  title="News and announcements | KAYISE IT"
  description="Official updates from KAYISE IT: new programmes, partnerships, events, and service announcements for clients, learners, and partners."
  keywords="KAYISE IT news, announcements, programmes, internships, South Africa ICT"
>
  <!-- Hero Section -->
  <x-page-hero 
      title="Announcements" 
      subtitle="Stay Updated"
      description="Get the latest news, updates, and opportunities from KAYISE IT"
      hero-id="announcements-hero"
      background-image="images/KayiseIT-Team.jpg" />

  <!-- Announcements Section -->
  <section class="bg-gray-50 py-20">
    <div class="container mx-auto px-4 max-w-7xl">
      @if($announcements->count() > 0)
        <!-- Announcements Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          @foreach($announcements as $announcement)
            @php
              $cardLink = $announcement->link ?? '#';
            @endphp
            <a href="{{ $cardLink }}" 
               class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group cursor-pointer h-full"
               @if($cardLink !== '#') target="{{ (strpos($cardLink, 'http') === 0) ? '_blank' : '_self' }}" @endif>
              <!-- Image Section (if available) -->
              @if($announcement->image)
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50">
                  <img src="{{ asset($announcement->image) }}" 
                       alt="{{ $announcement->title ?? 'Announcement' }}" 
                       class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                  <div class="absolute top-4 right-4">
                    @if($announcement->badge)
                      <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                            style="background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%); border: 1px solid rgba(34,197,94,0.5); color: #22C55E; box-shadow: 0 0 10px rgba(34,197,94,0.2);">
                        {{ $announcement->badge }}
                      </span>
                    @endif
                  </div>
                </div>
              @else
                <!-- Placeholder gradient background when no image -->
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900">
                  <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
                  <div class="absolute top-4 right-4">
                    @if($announcement->badge)
                      <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                            style="background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%); border: 1px solid rgba(34,197,94,0.5); color: #22C55E; box-shadow: 0 0 10px rgba(34,197,94,0.2);">
                        {{ $announcement->badge }}
                      </span>
                    @endif
                  </div>
                  <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                  </div>
                </div>
              @endif
              
              <!-- Content Section -->
              <div class="p-6 flex flex-col flex-grow">
                <!-- Date -->
                @if($announcement->created_at)
                  <p class="text-xs text-gray-500 mb-2">
                    {{ $announcement->created_at->format('M d, Y') }}
                  </p>
                @endif
                
                <!-- Title -->
                <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-200">
                  {{ $announcement->title ?? 'Announcement' }}
                </h3>
                
                <!-- Description -->
                @if($announcement->description)
                  <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                    {{ $announcement->description }}
                  </p>
                @endif
                
                <!-- CTA Button -->
                @if($cardLink !== '#')
                  <div class="inline-flex items-center text-sm font-semibold transition-colors duration-200 group/link mt-auto"
                       style="color: #22C55E;">
                    <span>Learn More</span>
                    <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                  </div>
                @endif
              </div>
            </a>
          @endforeach
        </div>

        <!-- Pagination -->
        @if($announcements->hasPages())
          <div class="flex justify-center mt-12">
            <nav class="flex items-center space-x-2">
              @if($announcements->previousPageUrl())
                <a href="{{ $announcements->previousPageUrl() }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                  <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                  </svg>
                  Previous
                </a>
              @endif

              @foreach(range(1, $announcements->lastPage()) as $page)
                @if($page == $announcements->currentPage())
                  <span class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-green-600 rounded-lg">
                    {{ $page }}
                  </span>
                @else
                  <a href="{{ $announcements->url($page) }}" 
                     class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    {{ $page }}
                  </a>
                @endif
              @endforeach

              @if($announcements->nextPageUrl())
                <a href="{{ $announcements->nextPageUrl() }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                  Next
                  <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </a>
              @endif
            </nav>
          </div>
        @endif
      @else
        <!-- Empty State -->
        <div class="text-center py-16">
          <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
          </svg>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">No announcements available</h3>
          <p class="text-gray-600 mb-6">Check back soon for the latest updates and news.</p>
          <a href="{{ route('home') }}" 
             class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Home
          </a>
        </div>
      @endif
    </div>
  </section>
</x-app-layout>

<style>
  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>

