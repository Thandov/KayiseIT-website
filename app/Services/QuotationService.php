<?php

// app/Services/QuotationService.php

namespace App\Services;
use App\Models\Quotation;


class QuotationService
{
    public function getUserQuotations($userId)
    {
        // Logic to fetch quotations for the given user
        return Quotation::where('user_id', $userId)->get();
    }
    public function viewQuote($qid)
    {
        // Logic to fetch quotations for the given user
        return Quotation::where('quotation_no', $qid)->first();
    }
}
