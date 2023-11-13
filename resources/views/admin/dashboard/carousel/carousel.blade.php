 <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
         <div class="p-6 bg-white border-b border-gray-200">
             <div class="flex items-center mb-4">
                 <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                     <i class="fas fa-cogs text-white"></i>
                 </div>
                 <div class="ml-5 w-0 flex-1">
                     <dl>
                         <dt class="text-sm font-medium text-gray-500 truncate">
                             <h3 class="text-lg leading-6 font-medium text-gray-900">Carousel</h3>
                         </dt>
                         <dd>
                             <div class="text-lg font-medium text-gray-900">
                                 <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage the front page.</p>
                             </div>
                         </dd>
                     </dl>
                 </div>
                 <div class="ml-auto">
                     <x-front-end-btn linking="{{ route('admin.dashboard.carousel.newcarousel') }}" color="blue" showme="add-service-btn" name="Add Carousel" />
                 </div>
             </div>
             <div class="md:grid md:grid-cols-2 gap-4">
                 <div class="carousel-container">
                     @include('admin.dashboard.carousel._partial', ['carousels' => $carousels])
                 </div>
                 <!-- Pagination links in your main view -->
                 <div class="pagination-links">
                     {{ $carousels->links() }}
                 </div>
             </div>
         </div>
     </div>
 </div>