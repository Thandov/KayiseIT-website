<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quatations') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-body">
                   <h1> {{ __('Websites Quotations') }} </h1>
                </div>

    <table class="table">
    <thead>
          <tr>
               <th scope="col">Quatation ID</th>
               <th scope="col">Website Type</th>
               <th scope="col">Number Of Pages</th>
               <th scope="col">Hosting</th>
               <th scope="col">Maintenance</th>
               <th scope="col">Price</th>
               <th scope="col">Action</th>
          </tr>
    </thead>
    <tbody>
      @foreach($websites as $website)
          <tr>
               <td>{{ $website->id }}</td>
               <td>{{ $website->type }}</td>
               <td>{{ $website->pages }}</td>
               <td>{{ $website->hosting }}</td>
               <td>{{ $website->maintenance }}</td>
               <td>{{ $website->total }}</td>
               <td>
                  <div class="container">
                       <div class="row">
                              <div class="col-6">
                                 <a href="{{ url('admin/viewwebquotes/'.$website->id) }}" class="btn btn-success">view</a>
                              </div>
                              <div class="col-6">
                                 <a href="{{ url('delete/'.$website->id) }}" class="btn btn-danger">Delete</a>
                              </div>
                       </div>
                  </div>
               </td>
          </tr>
          </tbody>
   @endforeach
        
     </table>


     <div class="row">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-end">
                 <a href="{{ url('create/'.$website->id) }}" class="btn btn-primary me-3">Create Quotation</a>
                
                 </div>
             </div>
         </div>

      </div>
        </div>
    </div>
</div>

</x-app-layout>