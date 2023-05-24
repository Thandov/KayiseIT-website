<x-app-layout>

   <div class="blog  pt-20" id="blog-page">
      <div class="row justify-content-center">
         <div class="col-md-10 mb-20">

            <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl">Blog Posts</h2>

            <div class="flex-nowrap sm:d-flex justify-content-center align-items-center">
               <div class="row py-10">

                  <div class="row justify-content-center">
                     <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 w-11/12 gap-5 p-4 ">

                        @foreach($blog as $blog)
                        <div class="max-w-sm lg:max-w-sm rounded overflow-hidden shadow-lg border">
                           <div class="card-content">
                              <div class="relative">
                                 <img class="w-full h-64 object-cover" src="{{ asset('images/'.$blog->icon)}}" alt="Blog Image">
                                 <span class="absolute top-0 left-0 bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mt-2 ml-2">Category</span>
                              </div>
                              <div class="px-6 py-4">
                                 <div class="font-bold text-xl mb-2">{{$blog['title']}}</div>
                                 <p class="text-gray-700 text-base ">{{$blog['subtitle']}}</p>
                              </div>
                              <div class="px-6 pt-2 pb-6">
                                 <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{{$blog['created_at']}}</span>
                                 <a href="{{ url('viewblog/'.$blog->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded-full float-right">View More</a>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>

</x-app-layout>