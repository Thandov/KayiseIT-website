<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuotationMail;
use App\Mail\WebsiteMail;
use App\Models\newQuotation;
use App\Models\Quotation;
use App\Models\SubServices;
use App\Models\SubService;
use App\Models\User;
use App\Models\Service;
use App\Models\Options;
use App\Models\Items;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class QuotationController extends Controller
{

    public function quote(Request $request)
    {
        // Create an empty array to store the selected options
        $selectedOptions = [];
        dd("34ff33" . $request->input());
        $quotation = new Quotation;
        $quotation->user_id = auth()->user()->id;
        $quotation->quotation_no = 'Q' . mt_rand(100000, 999999);
        $quotation->save();

        $subservice = Subservice::find($request->input('subservice_id'));
        $item = new Items;
        $item->user_id = auth()->user()->id;
        $item->name = $subservice->name;
        $item->price = $subservice->price;
        $item->qty = 1;
        $item->sub_total = $subservice->price;
        $item->QI_id = $quotation->quotation_no;
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
            $item->QI_id = $quotation->quotation_no;
            $item->save();
        }

        $total_price = Items::where('QI_id', $quotation->quotation_no)->sum('sub_total');
        $vat_total = $total_price * 0.15;
        $total = $total_price + $vat_total;
        $quotation->total_price = $total;
        $quotation->save();

        $userEmail = auth()->user()->email;
        $data = [
            'quotation' => $quotation,
            'total_price' => $total_price,
            'vat_total' => $vat_total,
            'items' => Items::where('QI_id', $quotation->quotation_no)->get(),
        ];

        /* Mail::send('emails.quotation', $data, function ($message) use ($userEmail, $quotation) {
            $message->to($userEmail)
                ->subject('Quotation Request - ' . $quotation->quotation_no);
            //->attachData(Quotation::generatePdf($quotation), 'quotation_'.$quotation->quotation_no.'.pdf');
        }); */

        $request->session()->put('selectedOptions', $selectedOptions);

        return back()->with('success', 'Quotation request submitted successfully!');
    }

    public function createQuote(Request $request)
    {
        

        $selectedOptions = $request->input('options');
        $optionQuantities = $request->input('quantity');
        $optionsubservice_ids = $request->input('subservice_id');

        $selectedOptionsData = [];

        foreach ($selectedOptions as $index => $selectedOption) {
            $optionData = [
                'name' => $selectedOption,
                'quantity' => $optionQuantities[$index] ?? 0, // If not set, default to 0
                'subservice_id' => $optionsubservice_ids, // If not set, default to 0
            ];
            $selectedOptionsData[] = $optionData;
        }
        // Create an empty array to store the selected options
        $selectedOptions = [];

        $quotation = new Quotation;
        $quotation->user_id = auth()->user()->id;
        $quotation->quotation_no = 'Q' . mt_rand(100000, 999999);
        $quotation->save();

        if ($optionsubservice_ids) {
            $subservice = Subservice::select('*')->where('subserv_id', $request->input('subservice_id'))->first();
            $item = new Items;
            $item->user_id = auth()->user()->id;
            $item->name = $subservice->name;
            $item->price = $subservice->price;
            $item->qty = 1;
            $item->sub_total = $subservice->price;
            $item->QI_id = $quotation->quotation_no;
            $item->save();
        }

        foreach ($selectedOptionsData as $key => $selectedOption) {
            $subservice = Subservice::select('*')->where('subserv_id', $request->input('subservice_id'))->first();
            $item = new Items;
            $item->user_id = auth()->user()->id;
            $item->name = $subservice->name;
            $item->price = $subservice->price;
            $item->qty = $selectedOption['quantity'];
            $item->sub_total = $subservice->price * $selectedOption['quantity'];
            $item->QI_id = $quotation->quotation_no;
            $item->save();
           
        }
        $request->session()->put('selectedOptions', $selectedOptions);

        //return back()->with('success', 'Quotation request submitted successfully!');
        return redirect()->route('viewsubservice.check', ['subservice_id' => $request->subservice_id, 'quotation_no' => $quotation->quotation_no])->with('success', 'Quotation created');
    }

    public function save_invoice(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'action' => 'required|string',
            'paypal_response' => 'required|string',
        ]);

        if ($validatedData['action'] === 'store') {
            // Retrieve the authenticated user
            $user = Auth::user();

            // Parse the PayPal response
            $response = json_decode($validatedData['paypal_response'], true);

            // Create a new instance of the Invoice model
            $invoice = new Invoice();

            // Set the attributes of the new invoice
            $invoice->user_id = $user->id;
            $invoice->invoice_no = $response['id'];
            $invoice->total_price = $response['purchase_units'][0]['amount']['value'];

            // Save the invoice to the database
            $invoice->save();

            // Return a response indicating success
            return response()->json(['message' => 'Invoice stored successfully']);
        }

        // Return a response indicating an invalid action
        return response()->json(['message' => 'Invalid action'], 400);
    }

    public function quotationPDF($id)
    {
        $quotation = Quotation::find($id);
        $items = Items::where('QI_id', $quotation->quotation_no)->get();

        $html = view('pdf.quotation', compact('quotation', 'items'))->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdfContent = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="quotation_' . $quotation->quotation_no . '.pdf"',
        ];

        return Response::make($pdfContent, 200, $headers);
    }

    public function invoicePDF($id)
    {
        $invoice = Invoice::find($id);
        $items = Items::where('QI_id', $invoice->invoice_no)->get();

        $html = view('pdf.invoice', compact('invoice', 'items'))->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdfContent = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice_' . $invoice->invoice_no . '.pdf"',
        ];

        return Response::make($pdfContent, 200, $headers);
    }
}
