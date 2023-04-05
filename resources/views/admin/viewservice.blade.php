<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('View Service') }}
      </h2>
   </x-slot>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-10">
            <form method="POST" action="{{ url('/service/'.$service->id) }}">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <input type="text" name="name" value="{{ $service->name }}">
        </div>
        <div class="card-body">
            <input type="hidden" name="id" value="{{ $service->id }}">
            <p>Description:</p>
            <textarea name="description">{{ $service->description }}</textarea>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <div class="row m-2">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-start">
                        <a href="{{ url('admin/services/addsubservices/'.$service->id) }}" class="btn btn-primary me-3">ADD SUBSERVICE</a>
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subservices as $subservice)
                    <tr>
                        <td>{{ $subservice->id }}</td>
                        <td>
                            <input type="text" name="subservices[{{ $subservice->id }}][name]" value="{{ $subservice->name }}" required>
                        </td>
                        <td>
                            <input type="text" name="subservices[{{ $subservice->id }}][price]" value="{{ $subservice->price }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-start">
                                <a href="{{ url('admin/viewsubservice/'.$subservice->id) }}" class="btn btn-primary me-3">View OPTIONS</a>
                            </div>
                        </td>
                        <td>  
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <form method="POST" action="{{ url('subservice/'.$subservice->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
                                            <button type="submit" style="background-color: red" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                                 <div class="d-flex align-items-center justify-content-end">
                                 <button style="background-color: grey" class="btn btn-secondary px-5 m-3" type="submit">Update</button>
                                 </div>
                              </div>
                          </div>
               </div>
            </form>
         </div>
      </div>
   </div>

   
</x-app-layout>
<script>
  $(document).ready(function() {
    $('.view-options-btn').click(function() {
      var subserviceId = $(this).data('subservice-id');

      $.ajax({
        type: 'GET',
        url: '/admin/viewoptions/'+ subserviceId,
        success: function(data) {
          $('#options-container').html(data);
        }
      });
    });
  });
</script>
