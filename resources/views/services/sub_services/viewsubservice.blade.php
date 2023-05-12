<x-app-layout>
<x-breadcrumb></x-breadcrumb>
   <div class="container py-5" id="viewsubservice">
      <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="card">
               <div class="card-header font-bold md:text-2xl"><h2>Get a quotation for :</h2></div>
               <div class="card-body">

                  <h1>{{ $subservice->name }}</h1>

                  <br>

                  <form action="{{ route('viewsubservice.quote') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
                     <input type="hidden" name="qty" value="1">


                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">
                                 <h3>Add-Ons</h3>
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
                     <button class="btn btn-success m-3" type="submit">Request Quotation</button>
                     @else
                     <a href="{{ route('login') }}" class="btn-success m-3">Request Quote</a>
                     @endif
                  </form>

               </div>
            </div>
         </div>
      </div>
   </div>

</x-app-layout>