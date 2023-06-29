<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CAREER MAPPING') }}
        </h2>
    </x-slot>
    <section id="occupations_dashboard">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white rounded-md shadow-md">
                <div class="p-4 sm:p-6">
                    <div>
                        <img class="h-28 w-28 rounded-md mx-auto" src="{{ asset('images/occupations_logo/'.$occupations->image) }}"></div>
                    <h3 class="text-center font-bold text-4xl my-4">{{ $occupations->occupation_name }}</h3>
                    <button id="spec-btn" class="inline-flex items-center mb-4 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Specialization</button>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    View
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Edit
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- start for each loop -->
                            @foreach($specializations as $specialization)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $specialization->specialization_name }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="grid grid-cols-3">
                                        <a href="{{ route('admin.career_mapping.viewspecialization', $specialization->spec_id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ url('/admin/career_mapping/specialization/edit',$specialization->spec_id)  }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('specializations.delete', $specialization->spec_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- end for each loop -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modal Title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div>
                        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
                        <form action="{{ route('addspecialization', $occupations->occup_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization Name:</label>
                                <input type="specialization" name="specialization" id="specialization" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div class="flex justify-end modal-footer">
                                <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelector('#spec-btn').addEventListener('click', function(e) {
            e.preventDefault();
            // your code here
            $('#myModal').modal('show');
        });
        document.querySelector('.close').addEventListener('click', function(e) {
            e.preventDefault();
            // your code here
            $('#myModal').modal('hide');
        });

        function previewImage(event) {
            var file = event.target.files[0];
            var formData = new FormData();
            formData.append('icon', file);

            var preview = document.getElementById('preview');
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(file);

            // Send the FormData object to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/store-form');
            xhr.send(formData);
        }
    </script>
</x-app-layout>