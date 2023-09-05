<!-- blog.blade.php -->

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/admin/admin_dashboard" class="ml-1 text-sm font-medium inline-flex">
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
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Categories</h3>
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All our categories.</p>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="ml-auto">
                        <x-front-end-btn linking="{{route('dashboard.blogs.categories')}}" color="blue" showme="show" name="Add Category" data-bs-toggle="modal" data-bs-target="#categories_modal" />
                        <x-front-end-btn linking="{{ route('dashboard.blogs.addblog') }}" color="blue" showme="add-blog-btn" name="Add Blog" />
                    </div>
                </div>
                <x-dynamic-table thead="" trcontent="{{json_encode($postCategories)}}" />

            </div>
        </div>
    </div>
    <!-- The modal container -->
    <div id="addCategoryModal" class="modal-backdrop fixed inset-0 flex items-center justify-center z-50 hidden">
        <!-- Modal content -->
        <div class="bg-white shadow-md rounded-lg p-6 w-1/2">
            <div class="modal-header flex justify-between items-center pb-4 border-b-2 border-gray-200">
                <h5 class="text-lg font-bold">Add Category</h5>
                <button class="hideModal text-gray-600 hover:text-gray-800 p-2">
                    &times;
                </button>
            </div>
            <form action="{{ route('dashboard.blogs.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body py-4" id="categoryInputsContainer">
                    <label class="block font-medium text-gray-700 mb-2">Category Name</label>
                    <div class="category-inputs">
                        <div class="flex items-center mb-2 rounded-lg px-4 py-2 bg-gray-100">
                            <span class="font-bold rounded-lg bg-blue-500 text-white w-8 h-8 flex items-center justify-center mr-2">1</span>
                            <input type="text" name="category_name[]" class="form-input w-full" required>
                        </div>
                    </div>
                    <button type="button" id="addCategoryButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">
                        Add Category
                    </button>
                </div>
                <div class="modal-footer flex justify-end pt-4 border-t-2 border-gray-200">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                    <button type="button" class="hideModal bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-4">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script type="text/JavaScript">
    // Get the trigger element that opens the modal (ID is "show")
    const showModalBtn = document.getElementById('show');

    // Get the modal container
    const modalContainer = document.getElementById('addCategoryModal');

    // Get the close button inside the modal
    const hideModalBtn = modalContainer.querySelector('.hideModal');

    // Add a click event listener to the trigger element
    showModalBtn.addEventListener('click', (event) => {
        // Prevent the default action (e.g., following a link or submitting a form)
        event.preventDefault();

        // Show the modal by removing the 'hidden' class
        modalContainer.classList.remove('hidden');
    });

    // Add a click event listener to the close button inside the modal
    hideModalBtn.addEventListener('click', () => {
        // Hide the modal by adding the 'hidden' class
        modalContainer.classList.add('hidden');
    });

    // Add a click event listener to the "Add Category" button
    const addCategoryButton = document.getElementById('addCategoryButton');
    addCategoryButton.addEventListener('click', () => {
        const categoryInputsContainer = document.getElementById('categoryInputsContainer');
        const categoryInputs = categoryInputsContainer.querySelector('.category-inputs');
        const categoryCount = categoryInputs.childElementCount;

        const newInputContainer = document.createElement('div');
        newInputContainer.classList.add('flex', 'items-center', 'mb-2', 'rounded-lg', 'px-4', 'py-2', 'bg-gray-100');

        const countSpan = document.createElement('span');
        countSpan.textContent = categoryCount + 1;
        countSpan.classList.add('font-bold', 'rounded-lg', 'bg-blue-500', 'text-white', 'w-8', 'h-8', 'flex', 'items-center', 'justify-center', 'mr-2');

        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'category_name[]'; // Use the '[]' to make it an array in form submission
        newInput.classList.add('form-input', 'w-full', 'focus:outline-none');

        newInputContainer.appendChild(countSpan);
        newInputContainer.appendChild(newInput);
        categoryInputs.appendChild(newInputContainer);
    });
</script>