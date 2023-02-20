<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Quotation') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quotation For: {{ $quotation->service_name }}</div>
                    <div class="card-body">
<br>
                        <p>Total Price:       R{{ $quotation->price }}</p>
<br>
                        <table class="table">
    <thead>
          <tr>
               
               <th scope="col">Subservice</th>
               <th scope="col">Choice</th>
               <th scope="col">Price</th>
          </tr>
    </thead>
    <tbody>
    @foreach(json_decode($quotation->option_name) as $key => $option)
          <tr>
               <td>{{ json_decode($quotation->subservices)[$key] }}</td>
               <td>{{ $option }}</td>
               <td>{{ json_decode($quotation->option_price)[$key] }}</td>
              
          </tr>
          @endforeach
          
          </tbody>
   
        
     </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
