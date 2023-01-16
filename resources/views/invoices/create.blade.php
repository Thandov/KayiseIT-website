<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('OUR SERVICES') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Create Invoice</div>
                <div class="card-body">
                    <form action="{{ route('invoices.create', $quotation->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $quotation->quotation_number }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Customer</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $quotation->user->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="invoice_date">Invoice Date</label>
                            <input type="text" class="form-control" id="invoice_date" name="invoice_date" value="{{ $quotation->quotation_date }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{ $quotation->total_amount }}" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Invoice</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>