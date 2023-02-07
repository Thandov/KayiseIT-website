<x-app-layout>
    
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('View Quotation') }}
      </h2>
   </x-slot>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-10">
            <div class="card">
               <div class="card-header">{{ $website->type }} Website</div>
               <div class="card-body">
               <table class="table">
               <tbody>
          <tr><td>Website ID: {{ $website->id }}</td></tr>
          <tr>
              <td>Number of Pages: {{ $website->pages }}</td>
              <td>R {{ $website->pages_price }}</td>
          </tr>
          <tr>
               <td>Hosting: {{ $website->hosting }} </td>
               <td>R {{ $website->hosting_price }}</td>
          </tr>
          <tr>
               
               <td>Maintenance: {{ $website->maintenance }}</td>
               <td>R {{ $website->maintenance_price }}</td>
               
          </tr>
          <tr>
               
               <td>- </td>
               <td> </td>
               
          </tr>
          <tr>
               
               <td>Total Price:</td>
               <td>R {{ $website->total }}</td>
               
          </tr>
          </tbody>
</table>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>
