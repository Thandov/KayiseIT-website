<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Or View Services') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        <div class="row m-2">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-start">
                 <a href="addservice" class="btn btn-primary me-3">ADD SERVICE</a>
                 </div>
             </div>
         </div>

        <div class="card">
            <div class="grid grid-cols-2 md:grid-cols-4 my-5 gap-4 md:gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($services as $service)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/service_logo/'.$service->icon)}}" class="card-img-top" alt="...">
                <div class="card-body">
                         <h2 class="card-title font-bold text-gray-90">{{$service['name']}}</h2>
                         <p class="card-text">{{$service['description']}}</p>
                     
                        <div class="row">
                               <div class="col">
                                  <a href="{{ url('admin/viewservice/'.$service->id) }}" style="width: 7rem;" class="btn btn-success">view</a>
                               </div>
                               <div class="col">
                                  <a href="{{ url('delete/'.$service->id) }}" style="width: 7rem;" class="btn btn-danger">Delete</a>
                               </div> 
                        </div>
                </div>
                </div>
            @endforeach
            </div>
        </div>
        </div>
    </div>
</div>
</x-app-layout>