<form action="{{ route('addoptions.add', $subservice->id) }}" method="post" enctype="multipart/form-data" class="px-3 py-3">
    @csrf


<div class="m-3 row">
<label for="description" class="col-sm-3 form-label fw-bold text-md-end">Option Name:</label> 
<div class="col-sm-9">              
<input type="name" name="name" id="name" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="description" class="col-sm-3 form-label fw-bold text-md-end">Price:</label> 
<div class="col-sm-9">              
<input type="decimal" name="price" id="price" class="form-control" />
</div>
</div>

<div class="m-3 row">
<label for="description" class="col-sm-3 form-label fw-bold text-md-end">Quantify:</label>
<div class="col-sm-9"> 
                <select id="" name="quantified"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            </div>


<div class="row">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-end">
                     <button  style="background-color: green" class="btn btn-success m-3" type="submit">Save</button>
                 </div>
             </div>
         </div>

</form>