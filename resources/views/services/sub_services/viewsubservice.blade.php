<x-app-layout>
   <!-- Meta tags -->
   @section('meta')
   @php

   $metaTitle = "$subservice->name";
   $metaDescription = "Transform Your Business with Our Comprehensive IT Services.";
   $metaKeywords = "$subservice->name, IT Company, Computers and Information Technology, Software, Technology, ICT, IT Services, Nelspruit, Near Me";
   @endphp
   @endsection
   <!-- Page Body -->
   <x-breadcrumb></x-breadcrumb>

   @if (session('success'))
   <div class="alert alert-success">
      {{ session('success') }}
   </div>
   @endif

   @if (session('error'))
   <div class="alert alert-danger">
      {{ session('error') }}
   </div>
   @endif
   <div class="md:grid md:grid-cols-3 max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 gap-4" style="height: 250px">
      <div class="col-span-1 h-100">
         <div class="bg-gray-100 h-100" style="padding-right: 20px; animation: scrollImage 10s infinite linear;">
            <img src="/" class="card-img-top" alt="Product Image" style="width: 100%; height: auto;">
         </div>
      </div>
      <div class="col-span-2">
         <form action="{{ route('viewsubservice.quote') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
            <h1 class="card-title font-bold text-5xl md:text-4xl" style="color: #64bc5c"> {{ $subservice->name }}</h1>

            <div class="data py-20 d-flex justify-content-between align-items-center mr-16">
               @if(Auth::check())
               <button class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">Request Quotation</button>
               @else
               <button type="button" id="checkModal-btn" class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-toggle="loginModal" data-target="#loginModal">Send Quotation</button>
               @endif
         </form>
      </div>
   </div>



   <!-- Modal -->
   @include('modal._loginModal')

</x-app-layout>

<script>
   $(document).ready(function() {
      // Retrieve the selected options from the session
      var selectedOptions = sessionStorage.getItem('selectedOptions');
      if (selectedOptions) {
         selectedOptions = JSON.parse(selectedOptions);
         // Set the previously selected checkboxes
         selectedOptions.forEach(function(option) {
            var checkbox = $('#option' + option.id);
            if (checkbox) {
               checkbox.prop('checked', true);
               if (option.qty && option.qty > 1) {
                  var qtyInput = $('#option' + option.id + '_qty');
                  if (qtyInput) {
                     qtyInput.val(option.qty);
                  }
               }
            }
         });
         // Update the checkout area with the selected options
         updateCheckoutArea(selectedOptions);
      }

      $('input[type="checkbox"]').on('change', function() {
         var selectedOptions = [];
         $('input[type="checkbox"]:checked').each(function() {
            var optionId = $(this).data("thapelo");
            var optionName = $(this).parent().text().trim();
            var optionQty = $('#option' + optionId + '_qty').val();
            var optionPrice = $('input[name="options[' + optionId + '][price]"]').val();
            selectedOptions.push({
               id: optionId,
               name: optionName,
               qty: optionQty,
               price: optionPrice
            });
         });
         updateCheckoutArea(selectedOptions);
         storeSelectedOptions(selectedOptions);

         // Update the form action with selected options
         var formAction = "{{ route('viewsubservice.check', ['subservice_id' => $subservice->id]) }}";
         if (selectedOptions.length > 0) {
            formAction += '?' + $.param({
               options: selectedOptions
            });
         }
         $('#checkout-form').attr('action', formAction);
      });

      function updateCheckoutArea(selectedOptions) {
         var checkoutContent = '';
         for (var i = 0; i < selectedOptions.length; i++) {
            var option = selectedOptions[i];
            checkoutContent += '<p>' + option.name + ' (Quantity: ' + option.qty + ')</p>';
         }
         $('.checkout-area').html(checkoutContent);
      }

      function storeSelectedOptions(selectedOptions) {
         // Store the selected options in the session
         sessionStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
      }

      // Remove the selected options from the session when the form is submitted
      $('#checkout-form').on('submit', function() {
         sessionStorage.removeItem('selectedOptions');
      });

      // Modal functionality
      document.querySelector('#loginModal-btn').addEventListener('click', function(e) {
         e.preventDefault();
         $('#loginModal').modal('show');
      });

      document.querySelector('#checkModal-btn').addEventListener('click', function(e) {
         e.preventDefault();
         $('#loginModal').modal('show');
      });

      document.querySelector('.close').addEventListener('click', function(e) {
         e.preventDefault();
         $('#loginModal').modal('hide');
      });
   });
</script>