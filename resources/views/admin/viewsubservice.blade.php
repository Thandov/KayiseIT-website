<x-app-layout>

   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('View Service') }}
      </h2>
   </x-slot>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-10">
            <div class="card">
               <div class="card-header">{{ $subservice->name }}</div>
               <div class="card-body">
                  <p>User ID: {{ $subservice->id }}</p>
                  <p>Price: R{{ $subservice->price }}</p>
               </div>
            </div>
            
         </div>
      </div>
      <br>
      <div class="d-flex align-items-center justify-content-start">
   <a href="{{ url('admin/services/addoptions/'.$subservice->id) }}" class="btn btn-primary me-3">ADD OPTIONS</a>
  </div>
  <br>

      <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">options</th>
                           <th scope="col">Price</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($options as $option)
                     <tr>
                         <td> {{ $option->name }}</td>
                         <td> {{ $option->price }}</td>
                         <td>  
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <form method="POST" action="{{ url('option/'.$option->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $option->id }}">
                            <button type="submit" style="background-color: red" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </td>
                     </tr>
                     @endforeach
</tbody>
</table>

   </div>

</x-app-layout>
