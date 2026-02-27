<div id="service-info">
    <form action="{{ isset($service) && optional($service)->id ? route('dashboard.editservice') : route('storeservice') }}" method="post" class="space-y-6">
        @csrf
        @if(isset($service) && optional($service)->id)
            @method('POST')
        @endif
        <input type="hidden" name="id" value="{{ optional($service)->service_id ?? '' }}">

        <div class="space-y-2">
            <label for="service-name" class="block text-xs font-medium text-gray-500">Name</label>
            <input type="text" id="service-name" name="name" required
                   class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-kb-500 focus:ring-1 focus:ring-kb-500"
                   value="{{ optional($service)->name ?? '' }}">
        </div>
        <div class="space-y-2">
            <label for="service-service_type" class="block text-xs font-medium text-gray-500">Type</label>
            <input type="text" id="service-service_type" name="service_type_label" readonly
                   class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-600"
                   value="{{ optional($service)->service_type ?? '' }}">
        </div>
        <div class="space-y-2">
            <label for="service-description" class="block text-xs font-medium text-gray-500">Description</label>
            <textarea id="service-description"
                          name="description"
                          rows="3"
                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-kb-500 focus:ring-1 focus:ring-kb-500"
                          placeholder="Describe what this networking service includes, who it’s for, and key benefits.">{{ optional($service)->description ?? '' }}</textarea>
        </div>

        <div class="pt-3 border-t border-gray-100">
            <p class="text-xs font-medium text-gray-500 mb-2">Pricing</p>
            <ul class="grid w-full gap-2 sm:grid-cols-2">
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
                           value="{{ optional($service)->price ?? '' }}"
                           placeholder="Enter fixed price">
                </div>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-kb-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-kb-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-600">
                {{ isset($service) && optional($service)->id ? 'Update service' : 'Save service' }}
            </button>
        </div>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var serviceType = "{{ optional($service)->service_type ?? '' }}"; // Assuming 'static' or 'dynamic'
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