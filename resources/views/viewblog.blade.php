<x-app-layout>
<div class="viewblog  pt-20">
      <div class="row justify-content-center">
            <div class="col-md-10 mb-20">

                  <div class="text-center flex justify-center">
                        <img src="{{ asset('images/'.$blog->icon)}}" height="300" class="card-img w-64 h-80 border-none" alt="Your Image">
                  </div>
                  
                  <h2 style="color: #64bc5c" class="card-title font-bold text-gray-90 pt-3 flex justify-center">{{$blog['title']}}</h2>
                  <p class="card-text">{{$blog['content']}}</p>

            </div>
      </div>
</div>

</x-app-layout>