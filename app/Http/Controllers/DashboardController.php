<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\User;
use Illuminate\Http\QuotationRequest;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if(Auth::user()->hasRole('client')){
            return view('home');
        }
        else if(Auth::user()->hasRole('business')){
            return view('home');

        }
        else if(Auth::user()->hasRole('admin')){
            return view('admin.admin_dashboard');
        }
    }
}
