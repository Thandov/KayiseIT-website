<?php

namespace App\Http\Controllers;
use App\Models\Creditcard;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function credit_card(Request $request)
    {
        $credit_card = new Creditcard;
        $credit_card->user_id = auth()->user()->id;
        $credit_card->card_number = $request->cardNumber;
        $credit_card->expiry_date = $request->expiryDate;
        $credit_card->cvv = $request->cvv;
        $credit_card->cardholder_name = $request->cardholderName;
        $credit_card->save();
          
        return redirect()->back();
    }
}
