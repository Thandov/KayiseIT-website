<!-- blog.blade.php -->

<x-app-layout>
    <div class="container mt-3">
        <h2 style="color: #64bc5c" class="mb-5  font-bold text-5xl md:text-5xl">Categories</h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                    <!-- modal with dialog tag  -->
                        <div>
                            <dialog id="addCategoryModal" class="bg-white shadow-md rounded-md w-1/2">
                                <div class="flex justify-end">
                                    <button id="hide">&times</button>
                                </div>
                                <form action="{{ route('admin.blogs.categories.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn me-auto btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </dialog>
                            <button id="show" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#categories_modal">Add Category</button>

                        </div>
                                               
                        <h3 class="text-lg leading-5 font-bold mb-2 text-gray-900">Category Name</h3> <!-- Adjust the font size (e.g., text-lg) as needed -->
                    </div>
                    <div class="card-body">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($postCategories as $categories)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b">
                                    <div class="text-sm text-gray-900">{{ $categories->category_name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium flex justify-end">
                                    <div class="flex">
                                        <x-front-end-btn linking="" color="blue" showme="" name="Edit" />
                                        <form action="" method="get" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
            </div>
        </div>
    </div>

    <script type="text/JavaScript">
        (function() {
        var dialog = document.getElementById('addCategoryModal');
        document.getElementById('show').onclick = function() {
            dialog.showModal(); //Use showModal() to make it a modal. Show() makes it a dialog 
        };
        document.getElementById('hide').onclick = function() {
            dialog.close();
        };
        })();
    </script>
</x-app-layout>
