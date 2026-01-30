<x-app-layout>
   
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">

    
    <form name="businessdash" id="businessdash" action="{{url('storetestimony-form')}}" method="post" enctype="multipart/form-data" class="px-3 py-3">
    @csrf

    <div class="m-3 row">
<label for="logo" class="col-sm-3 form-label fw-bold text-md-end">Icon:</label>
<div class="col-sm-9">
<input name="icon" class="form-control" type="file" id="logo">
</div>
</div>

<div class="m-3 row">
<label for="name" class="col-sm-3 form-label fw-bold text-md-end">Name:</label> 
<div class="col-sm-9">              
<input type="name" name="name" id="name" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="name" class="col-sm-3 form-label fw-bold text-md-end">Name:</label> 
<div class="col-sm-9">  
<label for="rating">Rate this item:</label>
        <select class="form-control" id="rating" name="rating">
            <option value="1">1 star</option>
            <option value="2">2 stars</option>
            <option value="3">3 stars</option>
            <option value="4">4 stars</option>
            <option value="5">5 stars</option>
        </select>
</div>
</div>

<div class="m-3 row">
<label for="testimony" class="col-sm-3 form-label fw-bold text-md-end">Testimonial:</label> 
<div class="col-sm-9">              
<input type="decimal" name="testimony" id="testimony" class="form-control" />
</div>
</div>


<div class="row">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-end">
                     <button  style="background-color: green" class="btn btn-success m-3" type="submit">ADD</button>
                 </div>
             </div>
         </div>

</form>

           </div>
        </div>
    </div>
</div>
</x-app-layout>

