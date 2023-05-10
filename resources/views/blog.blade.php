<x-app-layout>
         
         <div class="blog  pt-20" id="blog-page">
      <div class="row justify-content-center">
         <div class="col-md-10 mb-20">

      <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl">Blog Posts</h2>

           <div class="d-flex justify-content-center align-items-center">
              <div class="row py-10">
              
                @foreach($blog as $blog)
                   <div class="col-md-4 col-sm-6 mb-10">
                      <a href="{{ url('viewblog/'.$blog->id) }}">
                      <div class="card">
                <img src="{{ asset('images/'.$blog->icon)}}" class="card-img" alt="Your Image">
                <div class="card-body">
                         <h2 style="color: #64bc5c" class="card-title font-bold text-gray-90">{{$blog['title']}}</h2>
                         <p class="card-text">{{$blog['subtitle']}}</p>
                </div>
                </div>
                      </a>
                    </div>
               @endforeach
              </div>
           </div>

        </div>
      </div>
    </div>

</x-app-layout>