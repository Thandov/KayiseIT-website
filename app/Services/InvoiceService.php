<?php

// app/Services/InvoiceService.php

namespace App\Services;
use App\Models\Invoice;


class InvoiceService
{
    public function getUserInvoices($userId)
    {
        // Logic to fetch Invoice for the given user
        return Invoice::select('*')->where('user_id', $userId)->get();
    }
    public function viewInvoices($qid)
    {
        // Logic to fetch Invoice for the given user
        return Invoice::where('invoice_no', $qid)->first();
    }
}
