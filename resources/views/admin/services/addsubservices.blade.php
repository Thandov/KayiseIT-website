<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD SUBSERVICES') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                 <div class="card">

    <form action="{{ route('addsubservices.storing', $service->id) }}" method="post" enctype="multipart/form-data" class="px-3 py-3">
    @csrf

    <div class="m-3 row">
<label for="icon" class="col-sm-3 form-label fw-bold text-md-end">icon:</label>
<div class="col-sm-9">
<input name="icon" class="form-control" type="file" id="icon">
</div>
</div>

        <div class="row mt-3">
            <label for="name" class="col-sm-3 form-label fw-bold text-md-end">Subservice Name:</label>
            <div class="col-sm-8">
                <input name="name" id="name" type="text" class="form-control mb-3"/>
            </div>
        </div>


        <div class="row">
           <label for="service-type" class="col-sm-3 form-label fw-bold text-md-end">Subservice Type:</label> 
           <div class="col-sm-8">              
               <select type="subservice_type" name="subservice_type" id="subservice_type" class="form-control mb-3">
                 <option value="static">Static</option>
                 <option value="dynamic">Dynamic</option>
               </select>
           </div>
        </div>

        <div class="row">
            <label for="description" class="col-sm-3 form-label fw-bold text-md-end">Price:</label> 
            <div class="col-sm-8">              
                <input type="decimal" name="price" id="price" class="form-control mb-3" />
            </div>
        </div>

        <div class="row">
             <div class="col-11">
                 <div class="d-flex align-items-center justify-content-end ">
                     <button  style="background-color: green" class="btn btn-success m-3" type="submit">Submit</button>
                 </div>
             </div>
         </div>

            </div>
        </div>
    </div>
</div>



</x-app-layout>