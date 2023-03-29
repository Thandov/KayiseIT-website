<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="row m-2">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-start">
                 <a href="addblog" class="btn btn-primary me-3">ADD Blog</a>
                 </div>
             </div>
         </div>

         
<div class="blog pt-20">
  <div class="row justify-content-center">
    <div class="col-md-10 mb-20">

    <div class="d-flex justify-content-center align-items-center">
              <div class="row">
            @foreach($blog as $blog)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                <img src="{{ asset('images/'.$blog->icon)}}" class="card-img" alt="Your Image">
                <div class="card-body">
                         <h2 class="card-title font-bold text-gray-90">{{$blog['title']}}</h2>
                         <p class="card-text">{{$blog['subtitle']}}</p>
                     
                        <div class="row">
                               <div class="col">
                                  <a href="{{ url('admin/viewblogg/'.$blog->id) }}" style="width: 7rem;" class="btn btn-success">Edit</a>
                               </div>
                               <div class="col">
                                  <a href="{{ url('blog/delete/'.$blog->id) }}" style="width: 7rem;" class="btn btn-danger">Delete</a>
                               </div> 
                        </div>
                </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
        
    </div>
    </div>
</div>



</x-app-layout>

<style>

.blog .card-img {
  height: 150px; /* Make the image fill the entire height of the card */
  object-fit: cover; /* Scale the image while maintaining its aspect ratio */
}
</style>