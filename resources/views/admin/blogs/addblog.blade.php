<x-app-layout>
    
    <div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">

    
    <form name="businessdash" id="businessdash" action="{{url('storeblog-form')}}" method="post" enctype="multipart/form-data" class="px-3 py-3">
    @csrf

    <div class="m-3 row">
<label for="logo" class="col-sm-3 form-label fw-bold text-md-end">Icon:</label>
<div class="col-sm-9">
<input name="icon" class="form-control" type="file" id="logo">
</div>
</div>

<div class="m-3 row">
<label for="title" class="col-sm-3 form-label fw-bold text-md-end">Title:</label> 
<div class="col-sm-9">              
<input type="title" name="title" id="title" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="subtitle" class="col-sm-3 form-label fw-bold text-md-end">Sub Title:</label> 
<div class="col-sm-9">              
<input type="title" name="subtitle" id="subtitle" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="content" class="col-sm-3 form-label fw-bold text-md-end">Post:</label> 
<div class="col-sm-9">              
<textarea type="text" name="content" id="content" class="form-control"></textarea>
</div>
</div>


<div class="row">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-end">
                     <button  style="background-color: green" class="btn btn-success m-3" type="submit">Post</button>
                 </div>
             </div>
         </div>

</form>

           </div>
        </div>
    </div>
</div>
</x-app-layout>

