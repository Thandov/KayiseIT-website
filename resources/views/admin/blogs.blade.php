<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/dashboard" class="ml-1 text-sm font-medium inline-flex">
                                <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Dashboard</a>
                        </li>
                        <!--                         <a href="/admin/staff/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Staff
                        </a> -->
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">Blogs</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="border rounded-lg shadow-lg p-4">
            <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <h3 class="text-2xl leading-6 font-bold mb-4 text-gray-900">Blog Posts</h3>
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-2 py-3">
                        <div class="flex space-x-2 space-y-1">
                            <!-- Use flex container to make buttons close to each other -->
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
    </div>
</x-app-layout>