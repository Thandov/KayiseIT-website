<div class="blog  pt-20">
      <div class="row justify-content-center">
         <div class="col-md-10 mb-20">

<div class="text-center">
      <img src="{{ asset('images/'.$blog->icon)}}"  height="300" class="card-img" alt="Your Image">
</div>
      <h2 style="color: #64bc5c" class="card-title font-bold text-gray-90">{{$blog['title']}}</h2>
                         <p class="card-text">{{$blog['content']}}</p>
            

        </div>
      </div>
    </div>

    <style>
      .blog{
            width: 50%;
            margin: 50px;
      }
    </style>