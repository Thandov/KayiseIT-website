<x-app-layout>
   <!-- Meta tags -->
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
   <section class="bg-white">
      <div class="container md:flex justify-center py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
         <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">

               <ol class="relative border-l w-10/12 justify-center border-gray-200 dark:border-gray-700">
                  <li class="mb-10 ml-6">
                     <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                        <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                     </span>
                     <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Order Summary</h3>

                     <div class="mr-2">

                        <table class="w-2/3 sm:w-1/2 bg-white border border-gray-200">
                           <thead>
                              <tr>
                                 <th class="px-3 py-2 bg-gray-100 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                 <th class="px-3 py-2 bg-gray-100 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                 <th class="px-3 py-2 bg-gray-100 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="px-3 py-2 border-b border-gray-200">{{ ucfirst($subservice->name) }}</td>
                                 <td class="px-3 py-2 border-b border-gray-200">R{{ $subservice->price != intval($subservice->price) ? $subservice->price : intval($subservice->price)}}</td>
                                 <td class="px-3 py-2 border-b border-gray-200">1</td>
                              </tr>
                              @if (!empty($selectedOptions))
                              @foreach($selectedOptions as $option)
                              <tr>
                                 <td class="px-3 py-2 border-b border-gray-200">{{ ucfirst($option['name']) }}</td>
                                 <td class="px-3 py-2 border-b border-gray-200">R{{ $option['price'] != intval($option['price']) ? $option['price'] : intval($option['price']) }}</td>
                                 <td class="px-3 py-2 border-b border-gray-200">{{ $option['qty'] }}</td>
                              </tr>
                              @endforeach
                              @endif
                           </tbody>
                        </table>

                     </div>
                  </li>
                  <li class="ml-6">
                     <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                        <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                     </span>
                     <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Payment Details</h3>
                     <div class="radio m-4">
                        <label class="inline-flex items-center">
                           <input type="radio" class="form-radio text-indigo-600" name="radio-group" onclick="showCardForm()">
                           <span class="ml-2">credit/debit card</span>
                        </label>

                        <label class="inline-flex items-center">
                           <input type="radio" class="form-radio text-indigo-600" name="radio-group" onclick="showBankForm()">
                           <span class="ml-2">net banking</span>
                        </label>

                        <label class="inline-flex items-center">
                           <input type="radio" class="form-radio text-indigo-600" name="radio-group" onclick="showVoucherForm()">
                           <span class="ml-2">EFT Payment</span>
                        </label>
                     </div>

                     <div id="cardForm" style="display: none;">
                        <!-- Credit/Debit Card Form -->
                        <button class="bg-blue-500 mb-4 text-white px-4 py-2 rounded" onclick="showAddNewCardForm()">Add New</button>
                        <div id="addNewCardForm" style="display: none;">
                           <!-- Add New Credit/Debit Card Form -->
                           @include('checkout._creditcard_form')
                        </div>
                        <!-- cards -->
                        <div class="flex gap-3">
                           @foreach($credit_card as $credit)
                           <div class="box-border h-24 w-44 rounded p-4 border-4">
                              <input type="radio" name="credit_card" id="credit_card_{{$credit->card_number}}" value="{{$credit->card_number}}">
                              <label for="credit_card_{{$credit->card_number}}">{{$credit->card_number}}</label>
                           </div>
                           @endforeach

                        </div>

                     </div>

                     <div id="bankForm" style="display: none;">
                        <!-- Net Banking Form -->
                        <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded" onclick="showAddNewBankForm()">Add New</button>
                        <div id="addNewBankForm" style="display: none;">
                           <!-- Add New Net Banking Form -->
                           <form class="max-w-md mx-auto bg-white shadow p-6 rounded mt-4">
                              <!-- Form fields for adding a new net banking details -->
                           </form>
                        </div>
                     </div>

                     <div id="voucherForm" style="display: none;">
                        <!-- Voucher Form -->
                        <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded" onclick="showAddNewVoucherForm()">Add New</button>
                        <div id="addNewVoucherForm" style="display: none;">
                           <!-- Add New Voucher Form -->
                           <form class="max-w-md mx-auto bg-white shadow p-6 rounded mt-4">
                              <!-- Form fields for adding a new voucher details -->
                           </form>
                        </div>
                     </div>
                  </li>
               </ol>

               <button class="inline-flex m-4 ml-5 items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">PAy</button>

            </div>

            <div class="col">
               <div class="bg-white rounded-lg shadow p-4 mb-4">
                  <h2 class="text-lg font-bold mb-4">Order Details</h2>
                  <table class="w-full">
                     <tr>
                        <td>Price</td>
                        <td>R{{ $subtotal }}</td>
                     </tr>
                     <tr>
                        <td>Discount Price</td>
                        <td>$-20</td>
                     </tr>
                     <tr class="text-green-500">
                        <td>Total Savings</td>
                        <td>$30</td>
                     </tr>
                  </table>
               </div>

               @include('_pop')

               <span><a class="text-green-500" href="../terms">Terms & Conditions</a> Apply</span>

            </div>
         </div>
      </div>
   </section>
   <script>
      function showCardForm() {
         document.getElementById("cardForm").style.display = "block";
         document.getElementById("bankForm").style.display = "none";
         document.getElementById("voucherForm").style.display = "none";
      }

      function showBankForm() {
         document.getElementById("cardForm").style.display = "none";
         document.getElementById("bankForm").style.display = "block";
         document.getElementById("voucherForm").style.display = "none";
      }

      function showVoucherForm() {
         document.getElementById("cardForm").style.display = "none";
         document.getElementById("bankForm").style.display = "none";
         document.getElementById("voucherForm").style.display = "block";
      }

      function showAddNewCardForm() {
         document.getElementById("addNewCardForm").style.display = "block";
      }

      function showAddNewBankForm() {
         document.getElementById("addNewBankForm").style.display = "block";
      }

      function showAddNewVoucherForm() {
         document.getElementById("addNewVoucherForm").style.display = "block";
      }
   </script>
</x-app-layout>