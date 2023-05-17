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
   <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto" id="viewsubservice">
      <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="card drop-shadow-2xl bg-white mb-5">
               <div class="card-header font-bold md:text-2xl text-[#22C55E]"><h2>Get a quotation for :</h2></div>
               <div class="card-body p-5">
                  <h3 class="font-bold text-2xl">{{ $subservice->name }}</h3>
                  <br>
                  <form action="{{ route('viewsubservice.quote') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
                     <input type="hidden" name="qty" value="1">
                     <table class="table mb-5 w-full border-collapse">
                        <thead>
                           <tr>
                              <th scope="col p-2.5 text-left font-semibold text-lg border-b-2 border-[#333] text-[#333]">
                                 <h4 class="text-kayise-blue">Add-Ons</h4>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($options as $option)
                           <tr id="addonrow{{ $option->id }}">
                              <td>
                                 <input type="checkbox" name="options[{{$option->id}}][id]" value="{{ $option->id }}">{{ $option->name }}
                              </td>
                              <td>
                                 @if($option->quantified)
                                 <input type="number" name="options[{{$option->id}}][qty]" id="option{{ $option->id }}">
                                 @else
                                 <input type="hidden" name="options[{{$option->id}}][qty]" id="option{{ $option->id }}" value="1">
                                 @endif
                              </td>
                              <td>
                                 <input type="hidden" name="options[{{$option->id}}][name]" value="{{ $option->name }}">
                                 <input type="hidden" name="options[{{$option->id}}][price]" value="{{ $option->price }}">
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     <br>
                     @if (Auth::check())
                     <a class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">Request Quotation</a>
                     @else
                     <x-front-end-btn href="{{ route('login') }}">
                        {{ __('Request Quote') }}
                     </x-front-end-btn>
                     @endif
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>