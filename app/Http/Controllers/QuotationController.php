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
use Illuminate\Support\Facades\Response;


class QuotationController extends Controller
{

    public function quote(Request $request)
    {
        // Create an empty array to store the selected options
        $selectedOptions = [];

        $quotation = new Quotation;
        $quotation->user_id = auth()->user()->id;
        $quotation->quotation_no = 'Q' . Str::padLeft(Str::random(6), 6, '0');
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

        Mail::send('emails.quotation', $data, function ($message) use ($userEmail, $quotation) {
            $message->to($userEmail)
                ->subject('Quotation Request - ' . $quotation->quotation_no);
            //->attachData(Quotation::generatePdf($quotation), 'quotation_'.$quotation->quotation_no.'.pdf');
        });

        $request->session()->put('selectedOptions', $selectedOptions);

        return back()->with('success', 'Quotation request submitted successfully!');
    }

    public function sendInvoice($id)
    {
        $quotation = Quotation::findOrFail($id);
        // Logic for sending invoice to the user who submitted the quotation
        // You can use a library like Laravel Cashier to generate and send the invoice

        $invoice = new Invoice;
        $invoice->user_id = $quotation->user_id;
        $invoice->invoice_no = $quotation->quotation_no;
        $invoice->total_price = $quotation->total_price;
        // populate other fields as needed
        //$invoice->status = 'Unpaid'; // or 'Pending'
        $invoice->save();

        $items = Items::where('QI_id', $quotation->quotation_no)->get();

        $user = User::findOrFail($quotation->user_id);
        $data = [
            'quotation' => $quotation,
            'items' => Items::where('QI_id', $quotation->quotation_no)->get(),
        ];
        Mail::send('emails.invoice', $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Invoice');
        });
        return redirect()->back()->with('status', 'Invoice sent successfully!');
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
