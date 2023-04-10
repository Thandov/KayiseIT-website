<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add or View Services') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-bold text-gray-800">All Services</h3>
            <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Service
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($services as $service)
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="{{ asset('images/service_logo/'.$service->icon) }}" class="w-32 h-32 mx-auto mb-4" alt="{{ $service->name }}">

                <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $service->name }}</h4>

                <div class="flex justify-between">
                    <a href="{{ url('admin/viewservice/'.$service->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View
                    </a>
                    <form action="{{ url('delete/'.$service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>