<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\Quotation;
use App\Models\Items;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApplicationsController extends Controller
{
    public function drone_registration(Request $request)
    {
        $application = new Application();
        $application->user_id = Auth::user()->id;
        $application->name = $request->name;
        $application->surname = $request->surname;
        $application->dob = $request->dob;
        $application->gender = $request->gender;
        $application->age = $request->age;

        $application->highest_level = $request->highest_level;
        $application->school_name = $request->school_name;

        $application->number = $request->number;
        $application->address = $request->address;

        $application->guardian_name = $request->guardian_name;
        $application->relation = $request->relation;
        $application->guardian_number = $request->guardian_number;
        $application->guardian_email = $request->guardian_email;
        $application->guardian_address = $request->guardian_address;

        $application->kin_name = $request->kin_name;
        $application->kin_relation = $request->kin_relation;
        $application->kin_number = $request->kin_number;

        $application->course = $request->course;
        $application->paid = '0';
        $application->payment_date = 'null';

        $application->save();

        $total = 0;

        $quotation_no = 'Q' . mt_rand(100000, 999999);
        $quotation = new Quotation;
        $quotation->user_id = auth()->user()->id;
        $quotation->quotation_no = $quotation_no;
        $quotation->save();

        
                $item = new Items;
                $item->user_id = auth()->user()->id;
                $item->unq_id = mt_rand(100, 9999);
                $item->item = 'Drone Workshop 1';
                $item->qty = '1';
                $item->sub_total = 550;
                $item->QI_id = $quotation_no;
                $item->save();
                $total = $total + $item->sub_total;
            
            $vat = round($total * 15 / 100);
            $total_vat = $total + ($total * (15 / 100));
            $rounded_total_vat = round($total_vat / 100) * 100;

            //update the quotaion total value
            $quote = Quotation::where('quotation_no', $quotation_no)->first();
            $quote->total_price = $total;
            $quote->job_type = '4IR Training';
            $quote->vat = $vat;
            $quote->total_vat = $rounded_total_vat;
            $quote->save();
        

            $quotationData = [
                'quotation_no' => $quotation_no,
                'course' => $request->course,
                'total' => $total,
                'vat' => $vat,
                'total_vat' => $rounded_total_vat,
            ];
        
            return view('drone_application/banking_details', compact('quotationData'));
        }

    public function banking_details(){
        return view('drone_application/banking_details');
    }
}
