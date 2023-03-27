<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SubServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
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

Route::get('/',[DashboardController::class, 'home'])->name('home');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('services', function () {
    return view('services');
})->name('services');

Route::GET('services',[ServicesController::class, 'services'])->name('services');

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
Route::post('quote-form',[QuotationController::class, 'quote']);
Route::post('/invoices/create/{quotationId}', [InvoiceController::class, 'create'])->name('invoices.create');


//Admin 

Route::GET('/admin/admin_dashboard',[AdminController::class, 'index'])->name('admin.admin_dashboard');
Route::GET('/admin/quotations',[AdminController::class, 'quotations'])->name('admin.quotations'); 
Route::GET('/admin/viewquotations/{id}',[AdminController::class, 'viewquotations'])->name('admin.viewquotations'); 
Route::GET('/admin/users',[AdminController::class, 'users'])->name('admin.users');
Route::GET('/admin/viewuser/{id}',[AdminController::class, 'viewuser'])->name('admin.viewuser');
Route::GET('/admin/services',[AdminController::class, 'services'])->name('admin.services');
Route::get('/quotations/{id}/send-invoice', [QuotationController::class, 'sendInvoice'])->name('quotations.send-invoice');
Route::GET('/admin/viewservice/{id}',[AdminController::class, 'viewservice'])->name('admin.viewservice');
Route::GET('/admin/viewsubservice/{id}',[AdminController::class, 'viewsubservice'])->name('admin.viewsubservice');

Route::GET('/admin/testimonials',[AdminController::class, 'testimonials'])->name('admin.testimonials');
Route::GET('/admin/addtestimony',[AdminController::class, 'addtestimony'])->name('admin.addtestimony');

//update
Route::put('/subservices/{subservice_id}', [SubServicesController::class, 'updateSubservice']);
Route::put('/service/{id}', [ServicesController::class, 'updateService'])->name('service.update');

//delete
Route::get('quotations/delete/{id}',[AdminController::class, 'remove'])->name('admin.remove');
Route::get('users/delete/{id}',[AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('delete/{id}', [ServicesController::class, 'delete']);
Route::put('/subservice/{subservice_id}', [SubServicesController::class, 'destroy']);
Route::put('/updatesubservice/{id}', [SubServicesController::class, 'updateSubservice']);
Route::put('/option/{id}', [OptionsController::class, 'destroyoption']);

//Add services, subservices, options Blades

Route::GET('/admin/addservice',[ServicesController::class, 'addservice'])->name('admin.addservice');
Route::GET('/admin/newaddservice',[ServicesController::class, 'newaddservice'])->name('admin.newaddservice');
Route::get('admin/services/addsubservices/{id}', [SubServicesController::class, 'index'])->name('addsubservices');
Route::get('admin/services/addoptions/{id}', [OptionsController::class, 'options'])->name('addoptions');

//Forms
Route::post('store-form',[ServicesController::class, 'store']);
Route::post('storetestimony-form',[AdminController::class, 'storetestimony']);
Route::post('admin/services/subservice/{id}', [SubServicesController::class, 'store'])->name('subservice.store');
Route::post('admin/services/addsubservices/{id}', [SubServicesController::class, 'storing'])->name('addsubservices.storing');
Route::post('admin/services/addoptions/{id}', [OptionsController::class, 'add'])->name('addoptions.add');



//Service Controller

Route::get('viewservice/{id}',[ServicesController::class, 'show'])->name('show');
Route::get('viewsubservice/{id}',[SubServicesController::class, 'show'])->name('show');
Route::post('viewsubservice/quote',[QuotationController::class, 'quote'])->name('viewsubservice.quote');
Route::get('/admin/viewoptions/{id}', [OptionsController::class, 'viewoptions']);


Route::post('contact/contact',[ContactController::class, 'contact'])->name('contact.contact');
Route::post('footer/subscribe',[ContactController::class, 'subscribe'])->name('footer.subscribe');

require __DIR__.'/auth.php';
