<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CAREER MAPPING') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!--Grey Background-->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-2xl leading-6 font-bold mb-4 text-gray-900">Occupations</h3>
                    <!-- modal with dialog tag  -->
                    <div>
                        <dialog id="addOccupationsModal" class="bg-white shadow-md rounded-md w-1/2">
                            <div class="flex justify-end">
                                <button id="hide">&times</button>
                            </div>
                             <x-add-occupations-form />
                        </dialog>
                        <button id="show" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Occupation</button>
                    </div>
                    <!-- button Add Occuptions -->
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-lg">
                            <!--grid-->
                            <div class="grid grid-cols-1 md:grid-cols-4 flex justify-items-center gap-4 p-4">
                                <!--Card-->
                                @foreach($occupations as $occupation)
                                <div class="bg-white shadow-md rounded w-60 p-4">
                                    <img class="w-auto h-auto" src="{{ asset('images/occupations_logo/'.$occupation->image) }}">
                                    <h3 class="py-2 text-center">{{ $occupation->occupation_name }}</h3>
                                    <div class=" flex justify-center">
                                        <a href="{{ route('admin.admin_viewoccupations', $occupation->occup_id) }}" class="inline-flex items-center w-24 px-4 py-2 bg-blue-800 border-transparent rounded-l-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">View</a>
                                        <form action="{{ route('occupations.delete', $occupation->occup_id) }}" method="POST">
                                            @csrf <!--To secure the form -->
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center w-24 px-4 py-2 bg-red-800 border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript to provide the "Show/Close" functionality -->
    <script type="text/JavaScript">
        (function() {
        var dialog = document.getElementById('addOccupationsModal');
        document.getElementById('show').onclick = function() {
            dialog.showModal(); //Use showModal() to make it a modal. Show() makes it a dialog 
        };
        document.getElementById('hide').onclick = function() {
            dialog.close();
        };
        })();
    </script>
</x-app-layout>