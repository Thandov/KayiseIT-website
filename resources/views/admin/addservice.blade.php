<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD New Service') }}
        </h2>
    </x-slot>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">

    
    <form name="businessdash" id="businessdash" action="{{url('store-form')}}" method="post" enctype="multipart/form-data" class="px-3 py-3">
    @csrf

    <div class="m-3 row">
<label for="logo" class="col-sm-3 form-label fw-bold text-md-end">Logo:</label>
<div class="col-sm-9">
<input name="icon" class="form-control" type="file" id="logo">
</div>
</div>

<div class="m-3 row">
<label for="description" class="col-sm-3 form-label fw-bold text-md-end">Service Name:</label> 
<div class="col-sm-9">              
<input type="name" name="name" id="name" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="description" class="col-sm-3 form-label fw-bold text-md-end">Description:</label> 
<div class="col-sm-9">              
<input type="name" name="description" id="description" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="service-type" class="col-sm-3 form-label fw-bold text-md-end">Service Type:</label> 
<div class="col-sm-9">              
    <select type="service_type" name="service_type" id="service_type" class="form-control">
      <option value="static">Static</option>
      <option value="dynamic">Dynamic</option>
    </select>
</div>
</div>

<div class="m-3 row">
<label for="description" class="col-sm-3 form-label fw-bold text-md-end">Price:</label> 
<div class="col-sm-9">              
<input type="decimal" name="price" id="price" class="form-control" />
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

