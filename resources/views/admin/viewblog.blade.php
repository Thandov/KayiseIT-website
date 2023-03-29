<x-app-layout>
    

    <div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">

            <form method="POST" action="{{ url('/blog/'.$blog->id) }}">
    @csrf
    @method('PUT')

<div class="m-3 row">
<label for="title" class="col-sm-3 form-label fw-bold text-md-end">Title:</label> 
<div class="col-sm-9">              
<input name="title" value="{{ $blog->title }}" class="form-control">
</div>
</div>

<div class="m-3 row">
<label for="subtitle" class="col-sm-3 form-label fw-bold text-md-end">Sub Title:</label> 
<div class="col-sm-9">              
<input name="subtitle" value="{{ $blog->subtitle }}" class="form-control">
</div>
</div>

<div class="m-3 row">
<label for="content" class="col-sm-3 form-label fw-bold text-md-end">Post:</label> 
<div class="col-sm-9">              
<textarea name="content" value="{{ $blog->content }}" class="form-control">{{ $blog->content }}</textarea>
</div>
</div>


<div class="row">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-end">
                     <button  style="background-color: green" class="btn btn-success m-3" type="submit">Update</button>
                 </div>
             </div>
         </div>

</form>

           </div>
        </div>
    </div>
</div>
</x-app-layout>

