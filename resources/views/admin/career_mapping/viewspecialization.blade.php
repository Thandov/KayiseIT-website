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
                        <dialog id="addSpecializationsModal" class="bg-white shadow-md rounded-md w-1/2">
                            <div class="flex justify-end">
                                <button id="hide">&times</button>
                            </div>
                            <x-add-specializations-form></x-add-specializations-form>
                        </dialog>
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
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- start for each loop -->
                            @foreach($careerSteps as $careerStep)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $careerStep->step_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $careerStep->qualification }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ url('/admin/career_mapping/careersteps/edit',$careerStep->steps_id)  }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('careersteps.delete', $careerStep->steps_id) }}" method="POST">
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
    </script>
</x-app-layout>