<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CAREER MAPPING') }}
        </h2>
    </x-slot>
    <section id="viewOccupations">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white rounded-md shadow-md">
                <div class="p-4 sm:p-6">
                    <div>
                        <img class="h-28 w-auto rounded-md mx-auto" src="{{ asset('images/occupations_logo/'.$occupations->image) }}">
                    </div>
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
                                    <a href="{{ route('admin.career_mapping.viewspecialization', ['spec_id' => $specialization->spec_id]) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Specializations</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <!-- Modal Code  -->
                    <div class="modal-body">
                        <div>
                            <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
                            <form action="{{ route('addspecialization', $occupations->occup_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <table id="table" class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Specialization Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                action
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" name="spec_name[]" placeholder="Enter Specialization Name" id="specialization" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button type="button" name="add" id="add" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">add More</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    document.getElementById('add').addEventListener('click', function(e) {
    e.preventDefault();

        // Get the table body element
        var tableBody = document.querySelector('#table tbody');

        // Get the number of existing input fields
        var inputCount = tableBody.querySelectorAll('input[name^="spec_name"]').length;

        // Create a new table row
        var newRow = document.createElement('tr');

        // Create the cell for the specialization name input
        var nameCell = document.createElement('td');
        nameCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');

        // Create the input element for specialization name
        var specializationInput = document.createElement('input');
        specializationInput.setAttribute('type', 'text');
        specializationInput.setAttribute('name', 'spec_name[' + inputCount + ']');
        specializationInput.setAttribute('placeholder', 'Enter Specialization Name');
        specializationInput.setAttribute('id', 'specialization');
        specializationInput.classList.add('form-control', 'mt-1', 'block', 'w-full', 'py-2', 'px-3', 'border', 'border-gray-300', 'bg-white', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-green-500', 'focus:border-green-500');

        // Append the specialization input to the name cell
        nameCell.appendChild(specializationInput);

        // Create the cell for the action button
        var actionCell = document.createElement('td');
        actionCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'text-sm', 'font-medium');

        // Create the "Remove" button
        var removeButton = document.createElement('button');
        removeButton.setAttribute('type', 'button');
        removeButton.classList.add('inline-flex', 'items-center', 'px-4', 'py-2', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-xs', 'text-white', 'bg-red-600', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-500');
        removeButton.textContent = 'Remove';

        // Add an event listener to the "Remove" button to remove its parent row
        removeButton.addEventListener('click', function() {
        var row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);
        });

        // Append the "Remove" button to the action cell
        actionCell.appendChild(removeButton);

        // Append the cells to the new row
        newRow.appendChild(nameCell);
        newRow.appendChild(actionCell);

        // Append the new row to the table body
        tableBody.appendChild(newRow);


    });
    </script>
</x-app-layout>