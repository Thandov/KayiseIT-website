<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Creditcard;
use App\Models\SubService;
use App\Models\Items;
use App\Models\Invoice;
use GuzzleHttp\Client;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {

        return view('checkout/checkout');
    }

    public function check(Request $request, $subservice_id)
    {
        $subservice = Subservice::findOrFail($subservice_id);
        $selectedOptions = $request->input('options', []);

        $subtotal = $subservice->price;

        foreach ($selectedOptions as $option) {
            $subtotal += $option['price'];
        }

        $vat = $subtotal * 0.15;

        $total = $subtotal + $vat;

        $client = new Client();
        $response = $client->request('GET', 'https://api.exchangerate-api.com/v4/latest/USD');
        $exchangeData = json_decode($response->getBody(), true);
        $exchangeRate = $exchangeData['rates']['ZAR'];

        $totalUSD = $total / $exchangeRate;

        // Pass $subservice and $selectedOptions to the checkout blade or process them as needed
        return view('checkout/checkout', compact('subservice', 'selectedOptions', 'totalUSD', 'subtotal'));
    }

    public function quote(Request $request)
    {
        // Create an empty array to store the selected options
        $selectedOptions = [];

        $invoice = new Invoice;
        $invoice->user_id = auth()->user()->id;
        $invoice->invoice_no = 'I' . mt_rand(100000, 999999);
        $invoice->save();

        $subservice = Subservice::find($request->input('subservice_id'));
        $item = new Items;
        $item->user_id = auth()->user()->id;
        $item->name = $subservice->name;
        $item->price = $subservice->price;
        $item->qty = 1;
        $item->sub_total = $subservice->price;
        $item->QI_id = $invoice->invoice_no;
        $item->save();

        // Loop through all the options
        if (!is_null($request->options)) {
            foreach ($request->options as $option) {
                // Check if the checkbox is checked for this option
                if (!empty($option['id']) && !empty($option['qty'])) {
                    // If it is checked, add it to the selectedOptions array
                    $selectedOptions[] = $option;
                }
            }
        }

        // Loop through the selectedOptions array and print the selected options
        foreach ($selectedOptions as $option) {
            $option_id = $option['id'];
            $option_name = $option['name'];
            $option_qty = $option['qty'];
            $option_price = $option['price'];

            // Do something with the selected option
            $sub_total = $option_qty * $option_price;

            $item = new Items;
            $item->user_id = auth()->user()->id;
            $item->name = $option_name;
            $item->price = $option_price;
            $item->qty = $option_qty;
            $item->sub_total = $sub_total;
            $item->QI_id = $invoice->invoice_no;
            $item->save();
        }

        $total_price = Items::where('QI_id', $invoice->invoice_no)->sum('sub_total');
        $vat_total = $total_price * 0.15;
        $total = $total_price + $vat_total;
        $invoice->total_price = $total;
        $invoice->save();


        
        $userEmail = auth()->user()->email;
        $data = [
            'invoice' => $invoice,
            'total_price' => $total_price,
            'vat_total' => $vat_total,
            'items' => Items::where('QI_id', $invoice->invoice_no)->get(),
        ];

        Mail::send('emails.invoice', $data, function ($message) use ($userEmail, $invoice) {
            $message->to($userEmail)
                ->subject('Invoice - ' . $invoice->invoice_no);
            //->attachData(Quotation::generatePdf($quotation), 'quotation_'.$quotation->quotation_no.'.pdf');
        });

        $request->session()->put('selectedOptions', $selectedOptions);

        return back()->with('success', 'Quotation request submitted successfully!');
    }

    public function save_invoice(Request $request, $id)
    {
        // Validate the incoming request data
        $quotation = Quotation::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'invoice_no' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        // Create a new instance of the Invoice model
        $invoice = new Invoice();
        
        // Set the attributes of the new invoice
        $invoice->user_id = $validatedData['user_id'];
        $invoice->invoice_no = $validatedData['invoice_no'];
        $invoice->total_price = $validatedData['total_price'];

        // Save the invoice to the database
        $invoice->save();

        // Return a response indicating success
        return response()->json(['message' => 'Invoice stored successfully'], 201);
    }

}
