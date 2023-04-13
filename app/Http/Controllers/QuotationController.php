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
use App\Models\Service;
use App\Models\Options;
use App\Models\Items;
use App\Models\Invoice;
use Illuminate\Support\Str;


class QuotationController extends Controller
{

public function quote(Request $request){
    $options = $request->options;
    $optArray= [];
echo '<pre>';
print_r($options);
echo '</pre>';

    foreach ($options as $option) {
        if (!empty($option['qty']) && isset($option['name']) && isset($option['price'])) {
            $option_id = $option['id'];
            $option_name = $option['name'];
            $option_qty = $option['qty'];
            $option_price = $option['price'];
            // do something with option_id, option_name, option_qty, and option_price
            echo '<pre>';
            print_r($option_id);
            print_r($option_name);
            print_r($option_qty);
            print_r($option_price);
            echo '</pre>';
            
        }
        else{
            echo "it failed. name, price, qty empty";
        }
    }
    dd("echo");
$quotation = new Quotation;
$quotation->user_id = auth()->user()->id;
$quotation->quotation_no = 'Q'.Str::padLeft(Str::random(6), 6, '0');
$quotation->save();

$subservice = Subservice::find($request->input('subservice_id'));
$item = new Items;
$item->user_id = auth()->user()->id;
$item->name = $subservice->name;
$item->price = $subservice->price;
$item->QI_id = $quotation->quotation_no;
$item->save();


if (!is_null($request->option_ids)) {
foreach ($request->option_ids as $option_id) {
    $option = Options::find($option_id);

    $qty= $request->qty;
    $price= $option->price;
    $total= $qty*$price;

    $item = new Items;
    $item->user_id = auth()->user()->id;
    $item->name = $option->name;
    $item->price = $total;
    $item->QI_id = $quotation->quotation_no;
    $item->save();

    dd($qty);
}

}

    $total_price = Items::where('QI_id', $quotation->quotation_no)->sum('price');
$quotation->total_price = $total_price;
$quotation->save();

$userEmail = auth()->user()->email;
$data = [
    'quotation' => $quotation,
    'items' => Items::where('QI_id', $quotation->quotation_no)->get(),
];

Mail::send('emails.quotation', $data, function($message) use ($userEmail, $quotation) {
    $message->to($userEmail)
            ->subject('Quotation Request - '.$quotation->quotation_no);
            //->attachData(Quotation::generatePdf($quotation), 'quotation_'.$quotation->quotation_no.'.pdf');
});


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

$data = [
    'quotation' => $quotation,
    'items' => Items::where('QI_id', $quotation->quotation_no)->get(),
];
    Mail::send('emails.invoice', $data, function($message) {
        $message->to('recipient@example.com', 'Recipient Name')
                ->subject('Invoice');
    });
    return redirect()->back()->with('status', 'Invoice sent successfully!');
}

}