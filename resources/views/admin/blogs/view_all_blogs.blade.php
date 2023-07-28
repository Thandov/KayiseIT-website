<x-app-layout>
    <div class="border rounded-lg shadow-lg p-4">
        <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <h3 class="text-2xl leading-6 font-bold mb-4 text-gray-900">Blog Posts</h3>
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-2 py-3">
                        <div class="flex space-x-2 space-y-1">  <!-- Use flex container to make buttons close to each other -->
                            <form action="/admin/blogs/addblog" method="get">
                                @csrf
                                <x-front-end-btn linking="{{url('/admin/blogs/addblog')}}" color="blue" showme="" name="Add Blog" class="mb-4" />
                            </form>
                            <x-front-end-btn linking="{{url('/admin/blogs/blog')}}" color="blue" showme="" name="View Posts" />
                            <x-front-end-btn linking="{{url('/admin/blogs/categories')}}" color="blue" showme="" name="Categories" />
                        </div>
                    </th>
                   
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($blogs as $blog)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap border-b">
                        <div class="text-sm text-gray-900">{{ $blog->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium flex justify-end">
                        <div class="flex">
                            <x-front-end-btn linking="{{url('/admin/blogs/viewblog_edit', $blog->id)}}" color="blue" showme="" name="Edit" />
                            <form action="{{ url('/blog/delete', $blog->id) }}" method="get" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                    <!-- Table footer content -->
                </tr>
            </tfoot>
        </table>
    </div>
</x-app-layout>
