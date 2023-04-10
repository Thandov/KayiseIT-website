<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD New Service') }}
        </h2>
    </x-slot>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="bg-gray-100">
        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form name="businessdash" id="businessdash" action="{{url('store-form')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 relative">
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo:</label>
                            <div class="image-upload-box border-dashed border-gray-300 bg-white rounded-md shadow-sm">
                                <input name="icon" class="image-upload-input absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="logo" accept="image/*">
                                <div class="placeholder-text absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6 mb-2 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm2 2v8h8V6H4zm10 8a4 4 0 11-8 0 4 4 0 018 0zm-1.414-1.414a2 2 0 00-2.828-2.828l-1.414 1.414a4 4 0 005.656 5.656l1.414-1.414a2 2 0 00-2.828-2.828l-1.414 1.414zM12 10a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Drag and drop your logo or click to browse</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Service Name:</label>
                            <input type="name" name="name" id="name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Service Type:</label>
                            <select type="service_type" name="service_type" id="service_type" class="mt-1 form-select block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="static">Static</option>
                                <option value="dynamic">Dynamic</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                            <input type="decimal" name="price" id="price" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div class="flex justify-end">
                            <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" type="submit">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>