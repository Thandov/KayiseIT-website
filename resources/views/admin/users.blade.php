<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-body">
                   <h1> {{ __('Users') }} </h1>
                </div>

    <table class="table">
    <thead>
          <tr>
               <th scope="col">User ID</th>
               <th scope="col">User</th>
               <th scope="col">Email</th>
               <th scope="col">Action</th>
          </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
          <tr>
               <td>{{ $user->id }}</td>
               <td>{{ $user->name }}</td>
               <td>{{ $user->email }}</td>
               <td>
                  <div class="container">
                       <div class="row">
                              <div class="col-6">
                                 <a href="{{ url('admin/viewuser/'.$user->id) }}" class="btn btn-success">view</a>
                              </div>
                              <div class="col-6">
                                 <a href="{{ url('users/delete/'.$user->id) }}" class="btn btn-danger">Delete</a>
                              </div>
                       </div>
                  </div>
               </td>
          </tr>
          </tbody>
   @endforeach
        
     </table>


     <div class="row">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-end">
                 <a href="{{ url('create/'.$user->id) }}" class="btn btn-primary me-3">Add User</a>
                
                 </div>
             </div>
         </div>

      </div>
        </div>
    </div>
</div>

</x-app-layout>