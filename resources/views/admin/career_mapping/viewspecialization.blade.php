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
                    <table class="min-w-full divide-y divide-gray-200">
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
                        <tbody class="bg-white divide-y divide-gray-200 sortable-table-body"> <!-- start for each loop -->
                            @foreach($careerSteps as $index => $careerStep)
                            <tr data-step-id="{{ $careerStep->steps_id }}">
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
        <!-- dialog modal  -->
        <dialog id="addSpecializationsModal" class="bg-white shadow-md rounded-md w-1/2">
            <div class="flex justify-end">
                <button id="hide">&times</button>
            </div>
            <form action="{{url('addcareersteps-form')}}" method="post" enctype="multipart/form-data">
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

                                <!-- Display the step number using a span -->
                                <span class="text-sm text-gray-900 step-number">{{ $arrlength }}</span>
                                <input type="hidden" name="highest_value" value="{{ $arrlength }}">
                                <input type="hidden" name="step_number[]" value="{{ $arrlength }}" id="step_number" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
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
        (function () {
        var dialog = document.getElementById('addSpecializationsModal');
        document.getElementById('show').onclick = function () {
            dialog.showModal();
        };
        document.getElementById('hide').onclick = function () {
            dialog.close();
        };
        })();

        // Initialize inputCount with the highest value from the hidden input + 1
        var highestValueInput = document.querySelector('input[name="highest_value"]');
        var inputCount = parseInt(highestValueInput.value) + 1;

        document.getElementById('add').addEventListener('click', function (e) {
        e.preventDefault();

        // Get the table body element
        var tableBody = document.querySelector('#table tbody');

        // Create a new table row
        var newRow = document.createElement('tr');

        // Create the cell for the Step Number label
        var numCell = document.createElement('td');
        numCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');

        // Create the span element for displaying Step Number
        var stepNumberLabel = document.createElement('span');
        stepNumberLabel.classList.add('text-sm', 'text-gray-900', 'step-number');
        stepNumberLabel.textContent = inputCount; // Use the current inputCount as the step number label

        // Create the hidden input element for Step Number to submit its value
        var stepNumberInput = document.createElement('input');
        stepNumberInput.setAttribute('type', 'hidden');
        stepNumberInput.setAttribute('name', 'step_number[' + (inputCount - 1) + ']');
        stepNumberInput.value = inputCount - 1; // Use the current inputCount - 1 as the step number value

        // Append the label and hidden input to the numCell
        numCell.appendChild(stepNumberLabel);
        numCell.appendChild(stepNumberInput);

        // Create the cell for the Qualification name input
        var nameCell = document.createElement('td');
        nameCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');

        // Create the input element for qualification name
        var qualificationInput = document.createElement('input');
        qualificationInput.setAttribute('type', 'text');
        qualificationInput.setAttribute('name', 'qualification[' + (inputCount - 1) + ']');
        qualificationInput.setAttribute('placeholder', 'Enter Qualification Name');
        qualificationInput.setAttribute('id', 'qualification');
        qualificationInput.classList.add('form-control', 'mt-1', 'block', 'w-full', 'py-2', 'px-3', 'border', 'border-gray-300', 'bg-white', 'rounded-md', 'shadow-sm', 'focus:outline-none', 'focus:ring-green-500', 'focus:border-green-500');

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

        // Add an event listener to the "Remove" button to remove its parent row, update step numbers, and adjust inputCount
        removeButton.addEventListener('click', function () {
            var row = this.parentNode.parentNode;
            row.parentNode.removeChild(row);
            updateStepNumbers();
            inputCount--; // Decrement the inputCount when a row is removed
        });

        // Append the "Remove" button to the action cell
        actionCell.appendChild(removeButton);

        // Append the cells to the new row
        newRow.appendChild(numCell);
        newRow.appendChild(nameCell);
        newRow.appendChild(actionCell);

        // Append the new row to the table body
        tableBody.appendChild(newRow);

        inputCount++; // Increment the inputCount for the next step number
        });

        // Function to update step numbers after a row is removed
        function updateStepNumbers() {
        var stepNumberLabels = document.querySelectorAll('.step-number');
        stepNumberLabels.forEach(function (label, index) {
            label.textContent = index + 1;
        });
        }

        //Alert for input validation error 
        document.addEventListener("DOMContentLoaded", function() {
            var errorMessages = @json($errors->all());

            if (errorMessages.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: '<ul>' +
                            errorMessages.map(error => '<li>' + error + '</li>').join('') +
                          '</ul>',
                });
            }
        });

        //Alert for Career Step Successfully Added 
        document.addEventListener("DOMContentLoaded", function() {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                    });
                @endif
            });

            //Make table sortable
            document.addEventListener('DOMContentLoaded', function () {
            const tbody = document.querySelector('.sortable-table-body');
            const sortable = new Sortable(tbody, {
            animation: 150,
            onUpdate: function (evt) {
                // Get the new order of rows after dragging
                const rows = evt.from.children;
                const newOrder = Array.from(rows).map(row => row.dataset.stepId);

                // You can now send the newOrder array to your backend to update the database.
                // You may use Ajax or other Laravel methods to update the order.
                console.log(newOrder);

                // Update the displayed step numbers
                const stepNumberElements = document.querySelectorAll('.step-number');
                stepNumberElements.forEach((element, index) => {
                    element.textContent = index + 1;
                        });
                    },
                });
            });
    </script>
</x-app-layout>