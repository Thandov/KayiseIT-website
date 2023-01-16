<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $websites = DB::table('websites')->get();
        return view('admin.admin_dashboard', compact('websites'));
    }
}
