<x-app-layout>

   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('View Service') }}
      </h2>
   </x-slot>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-10">
            <div class="card">
               <div class="card-header">{{ $user->name }}</div>
               <div class="card-body">
                  <p>User ID: {{ $user->id }}</p>
                  <p>Email Address: {{ $user->email }}</p>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</x-app-layout>
