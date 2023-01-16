<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuotationRequest;
use App\Models\Website;
use Illuminate\Http\Request;
use Mail;
use App\Mail\QuotationMail;
use App\Mail\WebsiteMail;

class QuotationController extends Controller
{

    public function index()
    {
        
        Mail::to('excellentt7@gmail.com')->send(new QuotationMail());
            
    }

    public function store(Request $request)
    {
        

        $website = new Website;


        $type = $request->input('type');
        $pages = $request->input('pages');
        $hosting = $request->input('hosting');
        $maintenance = $request->input('maintenance');
        $pages_price = $request->input('pages_price');
        $hosting_price = $request->input('hosting_price');
        $maintenance_price = $request->input('maintenance_price');
        

        //pages price conditions
        
        if ($pages == 1)
        {
            $pages_price = 500;
        }
        else if($pages == 2){
            $pages_price = 1000;
        }
        else if($pages == 3){
            $pages_price = 1500;
        }
        else if($pages == 4){
            $pages_price = 2000;
        }
        else if($pages == 5){
            $pages_price = 2500;
        }
        else if($pages == null){
            $pages_price = 0;
        }
        else{
            $pages_price = 3000;
        }

        //hosting price conditions

        if ($hosting == 'yes')
        {
            $hosting_price = 250;
        }
        else{
            $hosting_price = 0;
        }


        //maintenance price conditions

        if ($maintenance == 'yes')
        {
            $maintenance_price = 400;
        }
        else{
            $maintenance_price = 0;
        }


        $total = $pages_price + $hosting_price + $maintenance_price;


        $website->type = $type;
        $website->pages = $request->pages;
        $website->pages_price = $pages_price;
        $website->hosting = $request->hosting;
        $website->hosting_price = $hosting_price;
        $website->maintenance = $request->maintenance;
        $website->maintenance_price = $maintenance_price;
        $website->total = $total;
        $website->save();
        return view('home')->with('status','Quotation Requested');
    }

    public function submit(QuotationRequest $request)
    {
        
        $type = $request->input('type');
        $pages = $request->input('pages');
        $hosting = $request->input('hosting');
        $maintenance = $request->input('maintenance');
        $pages_price = $request->input('pages_price');
        $hosting_price = $request->input('hosting_price');
        $maintenance_price = $request->input('maintenance_price');
        

        //pages price conditions
        
        if ($pages == 1)
        {
            $pages_price = 500;
        }
        else if($pages == 2){
            $pages_price = 1000;
        }
        else if($pages == 3){
            $pages_price = 1500;
        }
        else if($pages == 4){
            $pages_price = 2000;
        }
        else if($pages == 5){
            $pages_price = 2500;
        }
        else if($pages == null){
            $pages_price = 0;
        }
        else{
            $pages_price = 3000;
        }

        //hosting price conditions

        if ($hosting == 'yes')
        {
            $hosting_price = 250;
        }
        else{
            $hosting_price = 0;
        }


        //maintenance price conditions

        if ($maintenance == 'yes')
        {
            $maintenance_price = 400;
        }
        else{
            $maintenance_price = 0;
        }


        $total = $pages_price + $hosting_price + $maintenance_price;

        $website = new Website;
        $website->type = $type;
        $website->pages = $request->pages;
        $website->pages_price = $pages_price;
        $website->hosting = $request->hosting;
        $website->hosting_price = $hosting_price;
        $website->maintenance = $request->maintenance;
        $website->maintenance_price = $maintenance_price;
        $website->total = $total;
        $website->save();



        

        Mail::to(Auth::user()->email)->send(new WebsiteMail($request->type, $request->pages, $request->hosting, $request->maintenance, $pages_price, $hosting_price, $maintenance_price, $total));
        return view('home'); 

    } 
}