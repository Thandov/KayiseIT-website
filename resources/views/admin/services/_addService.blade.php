<div id="service-info" class="md:col-span-3">
    <form action="{{ isset($service) && $service->id ? route('dashboard.editservice') : route('storeservice') }}" method="post" class="space-y-6">
        @csrf
        @if(isset($service) && $service->id)
            @method('POST')
        @endif
        <input type="hidden" name="id" value="{{ $service->service_id ?? '' }}">

        <!-- Service details -->
        <div class="bg-white border border-gray-200 rounded-2xl p-5 space-y-4">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Service details</h2>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label for="service-name" class="text-sm font-medium text-gray-700">Service Name</label>
                    <input type="text"
                           id="service-name"
                           name="name"
                           required
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
                           value="{{ $service->name ?? '' }}">
                </div>

                <div class="space-y-1">
                    <label for="service-service_type" class="text-sm font-medium text-gray-700">Service Type</label>
                    <input type="text"
                           id="service-service_type"
                           name="service_type_label"
                           class="block w-full rounded-lg border-gray-200 bg-gray-50 text-gray-600 text-sm"
                           value="{{ $service->service_type ?? '' }}"
                           readonly>
                </div>
            </div>

            <div class="space-y-1">
                <label for="service-description" class="text-sm font-medium text-gray-700">Service Description</label>
                <textarea id="service-description"
                          name="description"
                          rows="4"
                          class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
                          placeholder="Describe what this networking service includes, who it’s for, and key benefits.">{{ $service->description ?? '' }}</textarea>
            </div>
        </div>

        <!-- Service price type -->
        <div class="bg-white border border-gray-200 rounded-2xl p-5 space-y-4">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Service price type</h3>
            <p class="text-xs text-gray-500">Choose whether this service has a single fixed price or multiple add‑ons.</p>

            <ul class="grid w-full gap-4 md:grid-cols-2">
                <li>
                    <input type="radio" id="static_type" name="service_type" value="static" class="hidden peer">
                    <label for="static_type" class="flex items-start justify-between w-full p-3 text-gray-700 bg-white border border-gray-200 rounded-xl cursor-pointer peer-checked:border-green-500 peer-checked:ring-1 peer-checked:ring-green-200 hover:bg-gray-50">
                        <div class="flex flex-col text-left">
                            <span class="text-sm font-semibold">Static</span>
                            <span class="mt-1 text-xs text-gray-500">Single fixed price, no additional options.</span>
                        </div>
                        <svg class="w-4 h-4 ml-3 text-gray-400 peer-checked:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="dynamic_type" name="service_type" value="dynamic" class="hidden peer">
                    <label for="dynamic_type" class="flex items-start justify-between w-full p-3 text-gray-700 bg-white border border-gray-200 rounded-xl cursor-pointer peer-checked:border-green-500 peer-checked:ring-1 peer-checked:ring-green-200 hover:bg-gray-50">
                        <div class="flex flex-col text-left">
                            <span class="text-sm font-semibold">Dynamic</span>
                            <span class="mt-1 text-xs text-gray-500">Base service with configurable add‑ons.</span>
                        </div>
                        <svg class="w-4 h-4 ml-3 text-gray-400 peer-checked:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </label>
                </li>
            </ul>
            <div class="optwrap">
                {{-- Dynamic pricing content --}}
                <div id="dynacont" class="mt-4 bg-gray-50 rounded-xl p-4" style="display: none;">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-semibold text-gray-800">Add‑ons</h4>
                        <p class="text-xs text-gray-500">Define add‑on items and their prices.</p>
                    </div>
                    <div id="dynamic-content" class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="flex-1">
                                <input type="text"
                                       class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500"
                                       placeholder="Add‑on name">
                            </div>
                            <input type="hidden" name="subservice_type" id="subservice_type" value="static" />
                            <div class="w-32">
                                <input type="text"
                                       class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm"
                                       placeholder="Price">
                            </div>
                            <input type="hidden" name="description" id="subservice_desc" value="null">
                            <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                                    onclick="addRow()">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Static pricing content --}}
                <div id="statcont" class="mt-4" style="display: none;">
                    <label for="service-price" class="block text-sm font-medium text-gray-700 mb-1">Service Price</label>
                    <input type="number"
                           id="service-price"
                           name="price"
                           step="0.01"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                           value="{{ $service->price ?? '' }}"
                           placeholder="Enter fixed price">
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-green-600 border border-transparent rounded-full font-semibold text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                {{ isset($service) && $service->id ? 'Update service' : 'Save service' }}
            </button>
        </div>
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