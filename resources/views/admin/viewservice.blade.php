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
               <div class="card-header">{{ $service->name }}</div>
               <div class="card-body">
                  <p>Service ID: {{ $service->id }}</p>
                  <p>Description: {{ $service->description }}</p>
               </div>
            </div>
            <br>
            <div class="card">
               <div class="card-header">Subservices</div>
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">Subservice ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($subservices as $subservice)
                        <tr>
                           <td>{{ $subservice->id }}</td>
                           <td>{{ $subservice->name }}</td>
                           <td>{{ $subservice->description }}</td>
                           <td>{{ $subservice->price }}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>
