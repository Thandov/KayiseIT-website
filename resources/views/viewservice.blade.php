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
                  <form action="{{route('quotations.quote')}}" method="post">
                  @csrf
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">Name</th>
                           <th scope="col">Select</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($subservices as $subservice)
                           <tr>
                              <td>{{ $subservice->name }}</td>
                              <td><input type="checkbox" name="subservices[]" value="{{$subservice->id}}"></td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <br>
                  <button  style="background-color: green" class="btn btn-success m-3" type="submit">Get Quotation</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>
