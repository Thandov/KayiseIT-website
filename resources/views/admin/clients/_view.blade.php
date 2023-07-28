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
            @foreach ($clients as $client)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $client->first_name }}</div>
                </td>
                <td class="pl-6 py-4 whitespace-nowrap font-medium flex justify-end">
                    <div class="flex gap-2">
                        <x-front-end-btn linking="/admin/clients/viewclient/{{ $client->user_id }}" color="blue" showme="" name="View" />
                        <form action="{{ url('admin/clients/delete', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $client->user_id }}">
                            <button type="submit" class="h-100 inline-flex items-center px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
            </tr>
        </tfoot>
    </table>
</div>