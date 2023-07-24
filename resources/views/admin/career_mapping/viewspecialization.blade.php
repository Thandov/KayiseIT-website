<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CAREER MAPPING') }}
        </h2>
    </x-slot>
    <section>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-4 sm:p-6">
                    <h3 class="text-center font-bold text-4xl my-4">
                        {{$specializations->specialization_name}}
                    </h3>
                    <!-- modal with dialog tag  -->
                    <div>
                        <button id="show" class="inline-flex items-center mb-4 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Career Step</button>
                    </div>
                    <div class="">
                        <table id="sortable-table" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Step Number
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Qualification
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Edit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="sortable-body" class="bg-white divide-y divide-gray-200">
                                <!-- start for each loop -->
                                @foreach($careerSteps as $index => $careerStep)
                                <tr class="sortable-row" data-step-id="{{ $careerStep->steps_id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 step-number">{{ $index + 1 }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $careerStep->qualification }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ url('/admin/career_mapping/careersteps/edit',$careerStep->steps_id)  }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('careersteps.delete', $careerStep->steps_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Career Step?');">
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
        </div>
        <!-- dialog modal  -->
        <dialog id="addSpecializationsModal" class="bg-white shadow-md rounded-md w-1/2">
            <div class="flex justify-end">
                <button id="hide">&times</button>
            </div>
            <form action="{{url('addcareersteps-form')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <!-- table  -->
                <table id="table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="sortable-row" data-step-id="{{ $careerStep->steps_id }}">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Step Number
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Qualification
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- Input field for spec_id -->
                                <input type="hidden" name="spec_id" value="{{ $specializations->spec_id }}">

                                <!-- Input field for occup_id -->
                                <input type="hidden" name="occup_id" value="{{ $occup_id }}">

                                <input type="hidden" name="highest_value" value="{{ $arrlength }}">
                                <input type="number" name="step_number[]" value="{{ $arrlength }}" id="step_number" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="text" name="qualification[]" placeholder="Enter Qualification Name" id="qualification" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button type="button" name="add" id="add" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">add More</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Submit</button>
            </form>
        </dialog>
    </section>
    <!-- JavaScript to provide the "Show/Close" functionality -->
    <script type="text/JavaScript">
        (function() {
        var dialog = document.getElementById('addSpecializationsModal');
        document.getElementById('show').onclick = function() {
            dialog.showModal(); //Use showModal() to make it a modal. Show() makes it a dialog 
        };
        document.getElementById('hide').onclick = function() {
            dialog.close();
        };
        })();

        // Get the number of existing input fields
        var highestValueInput = document.querySelector('input[name="highest_value"]');
        var inputCount = parseInt(highestValueInput.value);

        document.getElementById('add').addEventListener('click', function(e) {
            e.preventDefault();

            // Get the table body element
            var tableBody = document.querySelector('#table tbody');

            // Create a new table row
            var newRow = document.createElement('tr');

            // Create the cell for the Step Number name input
            var numCell = document.createElement('td');
            numCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');

            // Create the input element for Step Number
            var stepnumberInput = document.createElement('input');
            stepnumberInput.setAttribute('type', 'number');
            stepnumberInput.setAttribute('name', 'step_number[' + inputCount + ']');
            stepnumberInput.setAttribute('placeholder', 'Enter Step Number');
            stepnumberInput.setAttribute('id', 'step_number');
            stepnumberInput.classList.add('form-control', 'mt-1', 'block', 'w-full', 'py-2', 'px-3', 'border', 'border-gray-300', 'bg-white', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-green-500', 'focus:border-green-500');

            // Create the cell for the Qualification name input
            var nameCell = document.createElement('td');
            nameCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');

             // Create the input element for specialization name
             var qualificationInput = document.createElement('input');
             qualificationInput.setAttribute('type', 'text');
             qualificationInput.setAttribute('name', 'qualification[' + inputCount + ']');
             qualificationInput.setAttribute('placeholder', 'Enter Qualification Name');
             qualificationInput.setAttribute('id', 'qualification');
             qualificationInput.classList.add('form-control', 'mt-1', 'block', 'w-full', 'py-2', 'px-3', 'border', 'border-gray-300', 'bg-white', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-green-500', 'focus:border-green-500');
             inputCount++;
             stepnumberInput.value = inputCount; // Set the value of the input to inputCount
             
            // Append the specialization input to the name cell
            numCell.appendChild(stepnumberInput);

            // Append the specialization input to the name cell
            nameCell.appendChild(qualificationInput);

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
            newRow.appendChild(numCell);
            newRow.appendChild(nameCell);
            newRow.appendChild(actionCell);

            // Append the new row to the table body
            tableBody.appendChild(newRow); 
            
        });

        const sortableTable = document.getElementById('sortable-table');
        const sortableBody = document.getElementById('sortable-body');
        const sortableRows = sortableBody.getElementsByClassName('sortable-row');

        let draggingElement = null;

        // Function to update the position numbers and the database
        function updatePositionAndDatabase() {
            const rows = sortableBody.getElementsByClassName('sortable-row');
            for (let i = 0; i < rows.length; i++) {
                const stepId = rows[i].getAttribute('data-step-id');
                const stepNumberElement = rows[i].querySelector('.step-number');
                if (stepNumberElement) {
                    stepNumberElement.innerText = i + 1;
                    
                    fetch('/admin/career_mapping/viewspecialization', {
    method: 'POST',
    body: JSON.stringify({ stepId: stepId, newPosition: i + 1 }),
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
})
.then(response => response.json())
.then(data => {
    // Handle the response or do any necessary actions
})
.catch(error => {
    console.error('Error:', error);
});

                    
                }
            }
        }

        // Event listener for drag start
        sortableTable.addEventListener('dragstart', (e) => {
            draggingElement = e.target.closest('.sortable-row');
        });

        // Event listener for drag over
        sortableTable.addEventListener('dragover', (e) => {
            e.preventDefault();
            const targetElement = e.target.closest('.sortable-row');
            if (targetElement && draggingElement && targetElement !== draggingElement) {
                const rect = targetElement.getBoundingClientRect();
                const nextElement = (e.clientY - rect.top > rect.height / 2) ? targetElement.nextSibling : targetElement;
                sortableBody.insertBefore(draggingElement, nextElement);
                updatePositionAndDatabase();
            }
        });

        // Event listener for drag end
        sortableTable.addEventListener('dragend', () => {
            draggingElement = null;
        });
    </script>
</x-app-layout>