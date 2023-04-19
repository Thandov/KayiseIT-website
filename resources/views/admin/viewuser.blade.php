<x-app-layout>

   <div class="container my-5">
      <div class="row justify-content-center">
         <div class="col-md-5">
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
