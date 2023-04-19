<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Invoices') }}

        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">



                        <!-- Retrieve and display the quotation and its items -->
                        <div class="card-header">Invoice - {{ $invoice->invoice_no }}</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Item</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration + 1 }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->sub_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="text-right">
                                <h4>Total Price: {{ $invoice->total_price }}</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
