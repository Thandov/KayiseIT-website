    <div class="custom-container">
        <div id="boxA" class="box">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg thando">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <i class="fas fa-cogs text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Clients</h3>
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">All our clients.</p>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="ml-auto">
                            <a href="#" id="add-client-btn" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add Client</a>
                        </div>
                    </div>
                    @include('admin.dashboard.clients._view')
                </div>
            </div>
        </div>
        <div id="boxB" class="box">
            <a href="#" id="return-btn" class="btn btn-secondary">Return to Box A</a>
            @include('admin/dashboard/clients/newclient')
        </div>
    </div>