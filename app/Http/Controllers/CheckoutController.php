<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubService;
use App\Models\Creditcard;

use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('checkout/checkout');
    }

    public function check(Request $request, $subservice_id)
    {
        // Retrieve the selected subservice and options
        $subservice = Subservice::findOrFail($subservice_id);
        $selectedOptions = $request->input('options', []);

        $subtotal = $subservice->price;

        foreach ($selectedOptions as $option) {
            $subtotal += $option['price'];
        }


        $user = Auth::user();
        $credit_card = Creditcard::where('user_id', $user->id)->get();

        // Pass $subservice and $selectedOptions to the checkout blade or process them as needed
        return view('checkout/checkout', compact('subservice', 'selectedOptions', 'credit_card', 'subtotal'));
    }
}
