<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('View Service') }}
      </h2>
   </x-slot>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">{{ $service->name }}</div>
               <div class="card-body">
                  <p>{{ $service->description }}</p>
               </div>
            </div>
            <br>
            <div class="card">
               <div class="card-header">Get A Quotation</div>
               <form action="{{ route('viewservice.quote') }}" method="post" enctype="multipart/form-data">
  @csrf

  <!-- Service name input (hidden) -->
  <input type="hidden" name="service_name" value="{{ $service->name }}">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Select</th>
      </tr>
    </thead>
    <tbody>
    @foreach($subservices as $subservice)
<tr>
   <td>
      <!-- Subservice name input (hidden) -->
     <!-- <input type="hidden" name="subservices[]" value="{{ $subservice->name }}"> -->
      {{ $subservice->name }}
   </td>
   <td>{{ $subservice->description }}</td>
   <td>
      @if ($subservice->price_type === 'dynamic')
      <select name="option_name[]" class="mt-1 w-full py-2 px-2 text-center border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="updateOptionPrice(this)">
         <option value="" class="text-center" selected disabled hidden>-</option>
         @foreach(json_decode($subservice->option_name) as $key => $value)
         @if(isset(json_decode($subservice->option_price)[$key]))
         <option value="{{ $value->name }}" data-price="{{ json_decode($subservice->option_price)[$key]->price }}" data-subservice="{{ $subservice->name }}">
            {{ $value->name }}
         </option>
         @endif
         @endforeach
      </select>
      <!-- Option price input (hidden) -->
      <input type="hidden" name="option_price[]" value="0">
      <!-- Selected sub-service option (hidden) -->
      <input type="hidden" name="subservices[]" value="0">
      @else
      N/A
      @endif
   </td>
</tr>
@endforeach

    </tbody>
  </table>

  <!-- Total price input (display only) -->    
  <input type="hidden" name="total_price" id="total-price-input" value="0">


  <br>
  @if (Auth::check())
  <button style="background-color: green" class="btn btn-success m-3" type="submit">Get Quotation</button>
  @else
      <a href="{{ route('login') }}" class="btn btn-success m-3">Get Quote</a>
   @endif
</form>


            </div>
         </div>
      </div>
   </div>
</x-app-layout>

<script>
  function updateOptionPrice(selectElement) {
   var optionPrice = selectElement.options[selectElement.selectedIndex].getAttribute('data-price');
   var subservice = selectElement.options[selectElement.selectedIndex].getAttribute('data-subservice');
   selectElement.parentNode.querySelector('input[name="option_price[]"]').value = optionPrice;
   selectElement.parentNode.querySelector('input[name="subservices[]"]').value = subservice;

   // Calculate and display the total price
   var totalPrice = 0;
   var optionPriceInputs = document.querySelectorAll('input[name="option_price[]"]');
   for (var i = 0; i < optionPriceInputs.length; i++) {
      totalPrice += parseFloat(optionPriceInputs[i].value);
   }
   document.getElementById('total-price-input').value = totalPrice;
}

</script>