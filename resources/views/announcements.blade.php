<x-app-layout>
  <!-- Meta tags -->
  @section('meta')
  @php
  $metaTitle = "Announcements - Latest News & Updates from KAYISE IT";
  $metaDescription = "Stay updated with the latest announcements, news, programs, and opportunities from KAYISE IT. Discover new internship programs, service updates, and career development opportunities.";
  $metaKeywords = "Announcements, News, Updates, KAYISE IT, Internship Programs, IT Services, Career Opportunities, South Africa";
  @endphp
  @endsection

  <!-- Page Body -->
  <!-- Hero Section -->
  <x-page-header
      title="Announcements"
      subtitle="Stay Updated"
      description="Get the latest news, updates, and opportunities from KAYISE IT"
      hero-id="announcements-hero"
      background-image="images/KayiseIT-Team.jpg"
      height="h-96" />

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
               class="ki-media-card"
               @if($cardLink !== '#') target="{{ (strpos($cardLink, 'http') === 0) ? '_blank' : '_self' }}" @endif>
              @if($announcement->image)
                <img src="{{ asset($announcement->image) }}" 
                     alt="{{ $announcement->title ?? 'Announcement' }}">
              @else
                <div class="ki-media-card-bar"></div>
              @endif
              
              <div class="ki-media-card-body">
                @if($announcement->badge)
                  <span class="ki-badge mb-2">{{ $announcement->badge }}</span>
                @endif
                @if($announcement->created_at)
                  <p class="ki-media-date">
                    {{ $announcement->created_at->format('d M Y') }}
                  </p>
                @endif
                
                <h3 class="ki-card-title">
                  {{ $announcement->title ?? 'Announcement' }}
                </h3>
                
                @if($announcement->description)
                  <p class="ki-card-body">
                    {{ $announcement->description }}
                  </p>
                @endif
                
                @if($cardLink !== '#')
                  <span class="ki-card-link">Read announcement</span>
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

