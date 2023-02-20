<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Or View Services') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        <div class="row m-2">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-start">
                 <a href="addservice" class="btn btn-primary me-3">ADD SERVICE</a>
                
                 </div>
             </div>
         </div>




            <div class="card">

    <table class="table">
    <thead>
          <tr>
               <th scope="col">Service ID</th>
               <th scope="col">Name</th>
               <th scope="col">Description</th>
               <th scope="col">Price</th>
               <th scope="col">Action</th>
          </tr>
    </thead>
    <tbody>
      @foreach($services as $service)
          <tr>
               
               <td>{{$service['id']}}</td>
               <td>{{$service['name']}}</td>
               <td>{{$service['description']}}</td>
               <td>{{$service['price']}}</td>
               <td>
                  <div class="container">
                       <div class="row">
                              <div class="col-6">
                                 <a href="{{ url('admin/viewservice/'.$service->id) }}" class="btn btn-success">view</a>
                              </div>
                              <div class="col-6">
                                 <a href="{{ url('delete/'.$service->id) }}" class="btn btn-danger">Delete</a>
                              </div> 
                       </div>
                  </div>
               </td>
          </tr>
          </tbody>
   @endforeach

        
     </table>

      </div>
        </div>
    </div>
</div>
</x-app-layout>