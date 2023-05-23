<form class="max-w-md mx-auto bg-white shadow p-6 m-4 rounded" action="{{ route('checkout.credit_card') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <h2 class="text-lg font-bold mb-4">Credit/Debit Card Information</h2>

                              <div class="mb-4">
                                 <label class="block text-gray-700 text-sm font-bold mb-2" for="cardNumber">
                                    Card Number
                                 </label>
                                 <input type="text" id="cardNumber" name="cardNumber" class="form-input border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md" placeholder="Enter card number" required>
                              </div>

                              <div class="grid grid-cols-2 gap-4 mb-4">
                                 <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="expiryDate">
                                       Expiry Date
                                    </label>
                                    <input type="text" id="expiryDate" name="expiryDate" class="form-input border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md" placeholder="MM/YY" required>
                                 </div>

                                 <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cvv">
                                       CVV
                                    </label>
                                    <input type="text" id="cvv" name="cvv" class="form-input border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md" placeholder="Enter CVV" required>
                                 </div>
                              </div>

                              <div class="mb-4">
                                 <label class="block text-gray-700 text-sm font-bold mb-2" for="cardholderName">
                                    Cardholder Name
                                 </label>
                                 <input type="text" id="cardholderName" name="cardholderName" class="form-input border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md" placeholder="Enter cardholder name" required>
                              </div>

                              <div class="flex justify-end">
                                 <button type="submit" class="px-4 py-2 bg-indigo-500 text-white font-semibold rounded hover:bg-indigo-600">Submit</button>
                              </div>
                           </form>