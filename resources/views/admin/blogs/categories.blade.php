<!-- blog.blade.php -->

<x-app-layout>
    <div class="container mt-3">
        <h2 style="color: #64bc5c" class="mb-5  font-bold text-5xl md:text-5xl">Categories</h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        
                        <button id="show" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#categories_modal">Add Category</button>
                       
                        <h3 class="text-lg leading-5 font-bold mb-2 text-gray-900">Category</h3> <!-- Adjust the font size (e.g., text-lg) as needed -->
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

    <div class="modal modal-blur fade" id="categories_modal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="example-text-input"  wtx-context="F77A26B9-2B45-4A47-8640-B4F793352020">
                  </div>            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>
