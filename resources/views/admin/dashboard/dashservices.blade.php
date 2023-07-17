    <!-- the form -->
    <div class="px-4 py-5 mb-4">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                <i class="fas fa-cogs text-white"></i>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Services
                    </dt>
                    <dd>
                        <div class="text-lg font-medium text-gray-900">
                            {{ $services->count() }}
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="ml-auto">
                <x-front-end-btn linking="{{ route('admin.addservice') }}" color="blue" showme="add-service-btn" name="Add Service" />
            </div>
        </div>
        <div class="mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $service->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium flex justify-end">
                            <div class="flex">
                                <x-front-end-btn linking="'admin/viewservice/{{$service->id}}" color="blue" showme="" name="Edit" />
                                <form action="{{ url('delete/'.$service->id) }}" method="get" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 ml-4 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>{{ $services->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>