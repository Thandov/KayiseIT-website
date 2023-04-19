<x-app-layout>






<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">


                <div class="border p-4 rounded-md mb-4 md:col-span-5" id="subservice-list">
                    <div class="card-header mb-4">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-start">
                                    Clients
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-6 text-left">ID</th>
                                <th class="px-6 text-left">Name</th>
                                <th class="px-6 text-left">Email</th>
                                <th class="px-6 text-left">Client Type</th>
                                <th class="px-6 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $user)
                                <!-- Inside the <tbody> of #subservice-list -->
                                <tr>
                                    <td class="px-6 whitespace-nowrap">{{ $user->id }}</td>
                                    <td class="px-6 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 whitespace-nowrap">{{ $user->display_name }}</td>
                                    <td class="px-6 row">
                                        <div class="py-3 px-6 col-4">
                                            <a href="{{ url('admin/viewuser/'.$user->id) }}"
                                                title="View">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </div>
                                        <div class="py-3 px-6 col-4">
                                            <a href="{{ url('users/delete/'.$user->id) }}"
                                                title="delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>

                            @endforeach
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>







</div>

</x-app-layout>