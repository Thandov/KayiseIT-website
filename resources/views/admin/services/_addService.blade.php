<div id="service-info" class="md:col-span-3 p-4 sm:rounded-lg">
    <form action="{{ route('dashboard.editservice')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$service->service_id ?? ''}}">
        <!-- Input for Service Name -->
        <div class="mb-4">
            <label for="service-name" class="block text-gray-600 mb-2">
                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Service Name</h3>
            </label>
            <input type="text" id="service-name" name="name" class="cus-inp border rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $service->name ?? '' }}">
        </div>
        <!-- Input for Service Type -->
        <div class="mb-4">
            <label for="service-price" class="block text-gray-600 mb-2">
                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Service Type</h3>
            </label>
            <input type="text" id="service-service_type" name="service_type" class="cus-inp border rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $service->service_type ?? '' }}">
        </div>
        <div class="mb-4">
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Service Price Type?</h3>
            <ul class="grid w-full gap-4 md:grid-cols-2">
                <li>
                    <input type="radio" id="static_type" name="service_type" value="static" class="hidden peer" required>
                    <label for="static_type" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Static</div>
                            <div class="w-full">Fixed Price with no additions</div>
                        </div>
                        <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="dynamic_type" name="service_type" value="dynamic" class="hidden peer">
                    <label for="dynamic_type" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Dynamic</div>
                            <div class="w-full">There are add-ons for this service</div>
                        </div>
                        <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </label>
                </li>
            </ul>
            <div class="optwrap">
                <div class="bg-gray-100" id="dynacont" style="display: none;">
                    <!-- Dynamic content -->
                    <div id="dynamic-content">
                        <!-- Initial row -->
                        <div class="table-row">
                            <input type="text" class="border rounded px-4 py-2 w-1/5" placeholder="Name">
                            <input type="hidden" name="subservice_type" id="subservice_type" value="static" />
                            <input type="text" class="border rounded px-4 py-2 w-1/5" placeholder="Price">
                            <input type="hidden" name="description" id="subservice_desc" value="null">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="addRow()">Add</button>
                        </div>
                    </div>
                </div>


                <div id="statcont" style="display: none;">
                    <!-- Content for static type -->
                    <div class="mb-4">
                        <label for="service-price" class="block text-gray-600 mb-2">
                            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Service Price</h3>
                        </label>
                        <input type="number" id="service-price" name="price" class="cus-inp border rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $service->price ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Textarea for Service Description -->
        <div class="mb-4">
            <label for="service-description" class="block text-gray-600 mb-2">
                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Service Description</h3>
            </label>
            <textarea id="service-description" name="description" class="cus-inp border rounded-md p-2 w-full h-32 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $service->description ?? '' }}</textarea>
        </div>

        <!-- Save Button -->
        <x-front-end-btn linking="{{ route('dashboard.editservice')}}" color="submit" showme="" name="Save" />
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var serviceType = "{{$service->service_type ?? ''}}"; // Assuming 'static' or 'dynamic'
        var dynamicButton = document.getElementById("dynamic_type");
        var staticButton = document.getElementById("static_type");
        var dynacont = document.getElementById("dynacont");
        var statcont = document.getElementById("statcont");

        if (serviceType === "static") {
            staticButton.checked = true;
            dynacont.style.display = "none";
            statcont.style.display = "block";
        } else if (serviceType === "dynamic") {
            dynamicButton.checked = true;
            dynacont.style.display = "block";
            statcont.style.display = "none";
        }

        dynamicButton.addEventListener("click", function() {
            dynacont.style.display = "block";
            statcont.style.display = "none";
        });

        staticButton.addEventListener("click", function() {
            dynacont.style.display = "none";
            statcont.style.display = "block";
        });
    });

    // Function to add a new row to the table
    function addRow() {
        const dynamicContent = document.getElementById('dynamic-content');
        const newRow = document.createElement('div');
        newRow.classList.add('table-row');
        newRow.innerHTML = `
                <input type="text" class="border rounded px-4 py-2 w-1/5" placeholder="Name">
                            <input type="hidden" name="subservice_type" id="subservice_type" value="static"/>
                            <input type="text" class="border rounded px-4 py-2 w-1/5" placeholder="Price">
                            <input type="hidden" name="description" id="subservice_desc" value="null">
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="removeRow(this)">Remove</button>
            `;
        dynamicContent.appendChild(newRow);
    }

    // Function to remove a row from the table
    function removeRow(button) {
        const row = button.parentElement;
        row.remove();
    }
</script>