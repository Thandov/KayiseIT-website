<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg thando">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                <i class="fas fa-cogs text-white"></i>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Quotations</h3>
                    </dt>
                    <dd>
                        <div class="text-lg font-medium text-gray-900">
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">All our Quotations.</p>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left">ID</th>
                    <th class="text-left">Quotation No.</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $quotation)
                <!-- Inside the <tbody> of #subservice-list -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $quotation->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $quotation->quotation_no }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $quotation->total_price }}</td>
                    <td class="py-3 px-6 text-center row">
                        <div class="py-3 px-6 col-4">
                            <a href="{{ url('dashboard/viewquotations/'.$quotation->id) }}" title="View">
                                <i class="far fa-eye"></i>
                            </a>
                        </div>
                        <div class="py-3 px-6 col-4">
                            <a href="{{ url('dashboard/download_quotation/'.$quotation->id) }}?format=pdf" title="download">
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                        <div class="py-3 px-6 col-4">
                            <a href="{{ url('quotations/delete/'.$quotation->id) }}" title="delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="pagination-quotations">

            {{ $quotations->appends([
                'quotationPage' => request()->input('quotationPage'),
                'servicePage' => request()->input('servicePage'),
                'carouselPage' => request()->input('carouselPage'),
                'invoicePage' => request()->input('invoicePage')
                ])->links() }}
        </div>
    </div>