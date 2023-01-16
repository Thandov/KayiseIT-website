<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create($quotationId)
    {
        // Retrieve the quotation record from the quotations table
        $quotation = Quotation::find($quotationId);

        // Create a new invoice record
        $invoice = new Invoice();

        // Copy over the relevant information from the quotation
        $invoice->invoice_number = $quotation->quotation_number;
        $invoice->user_id = $quotation->user_id;
        $invoice->invoice_date = $quotation->quotation_date;
        $invoice->total_amount = $quotation->total_amount;
        $invoice->status = 'sent';

        // Save the invoice record
        $invoice->save();

        // Loop through the quotation items and create corresponding invoice items
        foreach ($quotation->items as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->service_id = $item->service_id;
            $invoiceItem->quantity = $item->quantity;
            $invoiceItem->price = $item->price;
            $invoiceItem->save();
        }

        return view('invoice.created', ['invoice' => $invoice]);
    }
}

