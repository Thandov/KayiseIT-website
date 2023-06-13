<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Career Mapping') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!--Grey Background-->
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Occupations</h3>
                <!-- button Add Occuptions -->
                <a id="open-dialog" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Occupation</a>
                <div class="mt-5">
                    <div class="bg-gray-200 rounded-lg">
                        <!--grid-->
                        <div class="grid grid-cols-4 sm:grid-cols-1 flex justify-items-center gap-4 p-4">
                            <!--Card-->
                            <div class="bg-white shadow-md rounded w-60 p-4">
                                <img class="w-40 h-40" src="../images/layers-removebg-preview.png">
                                <h3 class="py-2">Occupation Name</h3>
                                <button class="inline-flex items-center w-24 px-4 py-2 bg-blue-800 border-transparent rounded-l-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">View</button><button class="inline-flex items-center w-24 px-4 py-2 bg-red-800 border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>