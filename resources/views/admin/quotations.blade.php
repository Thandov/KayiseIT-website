<x-app-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">


                <div class="border p-4 rounded-md mb-4 md:col-span-5" id="subservice-list">
                    <div class="card-header mb-4">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-start">
                                    Quotations
                                </div>
                            </div>
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

                </div>
            </div>
        </div>
    </div>

</x-app-layout>