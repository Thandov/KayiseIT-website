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
               

    <table class="table">
    <thead>
          <tr>
               <th scope="col">ID</th>
               <th scope="col">Quotation Number</th>
               <th scope="col">Price</th>
               <th scope="col">Action</th>
          </tr>
    </thead>
    <tbody>
      @foreach($quotations as $quotation)
          <tr>
               <td>{{ $quotation->id }}</td>
               <td>{{ $quotation->quotation_no }}</td>
               <td>{{ $quotation->total_price }}</td>
               <td>
                  <div class="container">
                       <div class="row">
                              <div class="col-6">
                                 <a href="{{ url('admin/viewquotations/'.$quotation->id) }}" class="btn btn-success">view</a>
                              </div>
                              <div class="col-6">
                                 <a href="{{ url('quotations/delete/'.$quotation->id) }}" class="btn btn-danger">Delete</a>
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