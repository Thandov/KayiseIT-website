<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SubServicesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/navbar/about', function () {
    return view('navbar.about');
})->name('navbar.about');

Route::get('/navbar/contact', function () {
    return view('navbar.contact');
})->name('navbar.contact');

Route::get('/navbar/services', function () {
    return view('navbar.services');
})->name('navbar.services');

Route::GET('/navbar/services',[ServicesController::class, 'services'])->name('navbar.services');



//services

Route::get('/services/website', function () {
    return view('services.website');
})->name('services.website');

Route::get('/services/software', function () {
    return view('services.software');
})->name('services.software');

Route::get('/services/kit', function () {
    return view('services.kit');
})->name('services.kit');

Route::get('/services/office', function () {
    return view('services.office');
})->name('services.office');

Route::get('/services/marketing', function () {
    return view('services.marketing');
})->name('services.marketing');

Route::get('/services/network', function () {
    return view('services.network');
})->name('services.network');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\http\Controllers\DashboardController@index')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//Quotations

//Route::post('store-form',[QuotationController::class, 'store']);
Route::get('/send',[QuotationController::class, 'index']);
Route::post('submit-form',[QuotationController::class, 'submit']);
Route::post('/invoices/create/{quotationId}', [InvoiceController::class, 'create'])->name('invoices.create');


//Admin 

Route::GET('/admin/admin_dashboard',[AdminController::class, 'index'])->name('admin.admin_dashboard');
Route::GET('/admin/quotations',[AdminController::class, 'quotations'])->name('admin.quotations');
Route::GET('/admin/viewwebquotes/{id}',[AdminController::class, 'viewwebquotes'])->name('admin.viewwebquotes');
Route::get('delete/{id}',[AdminController::class, 'remove'])->name('admin.remove');
Route::GET('/admin/users',[AdminController::class, 'users'])->name('admin.users');
Route::GET('/admin/viewuser/{id}',[AdminController::class, 'viewuser'])->name('admin.viewuser');
Route::get('delete/{id}',[AdminController::class, 'removeuser']);
Route::GET('/admin/services',[AdminController::class, 'services'])->name('admin.services');

Route::GET('/admin/addservice',[ServicesController::class, 'addservice'])->name('admin.addservice');
Route::GET('/admin/newaddservice',[ServicesController::class, 'newaddservice'])->name('admin.newaddservice');
Route::get('admin/services/newaddservice/{id}', [SubServicesController::class, 'index'])->name('newaddservice');
//Route::get('admin/services/subservice/{id}', 'ServicesController@index')->name('subservice');

Route::GET('/admin/viewservice/{id}',[AdminController::class, 'viewservice'])->name('admin.viewservice');
Route::post('store-form',[ServicesController::class, 'store']);
Route::get('delete/{id}',[AdminController::class, 'removeservice'])->name('admin.removeservice');

Route::post('admin/services/subservice/{id}', [SubServicesController::class, 'store'])->name('subservice.store');
Route::post('admin/services/newaddservice/{id}', [SubServicesController::class, 'storing'])->name('newaddservice.storing');

//Service Controller

Route::get('viewservice/{id}',[ServicesController::class, 'show'])->name('show');

Route::post('quotations',[QuotationController::class, 'quote'])->name('quotations.quote');

require __DIR__.'/auth.php';
