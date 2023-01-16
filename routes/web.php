<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\QuotationController;
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

Route::get('/navbar/about', function () {
    return view('navbar.about');
})->name('navbar.about');

Route::get('/navbar/contact', function () {
    return view('navbar.contact');
})->name('navbar.contact');

Route::get('/navbar/services', function () {
    return view('navbar.services');
})->name('navbar.services');



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


require __DIR__.'/auth.php';
