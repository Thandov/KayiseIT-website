<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SubServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OccupationsController;
use App\Http\Controllers\SpecializationsController;
use App\Http\Controllers\CareerStepsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Occupations;

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

Route::get('/', [DashboardController::class, 'home'])->name('home');


Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('services', function () {
    return view('services');
})->name('services');

Route::get('career-mapping', function () {
    return view('career-mapping');
})->name('career-mapping');




Route::GET('services', [ServicesController::class, 'services'])->name('services');

//terms and conditions

Route::get('terms', function () {
    return view('terms');
})->name('terms');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//Quotations

//Route::post('store-form',[QuotationController::class, 'store']);
Route::post('quote-form', [QuotationController::class, 'quote'])->middleware('auth');
Route::post('/invoices/create/{quotationId}', [InvoiceController::class, 'create'])->name('invoices.create');

//=================================================Admin ==================================================
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::GET('/admin/clients/', [AdminController::class, 'all_employees'])->name('admin.clients');

    Route::GET('/admin/clients/newclient', function () {
        return view('admin.clients.newclient');
    })->name('admin.client.newclient');

    Route::GET('/admin/staff/', [AdminController::class, 'all_employees'])->name('admin.staff');
    Route::GET('/admin/staff/newstaff', function () {
        return view('admin.staff.newstaff');
    })->name('admin.staff.newstaff');
    Route::post('/admin/staff/create', [AdminController::class, 'new_employee']);
    Route::DELETE('/admin/staff/delete/{id}', [AdminController::class, 'delete_employee'])->name('admin.staff.delete');
    Route::POST('/admin/staff/viewstaff/update/', [AdminController::class, 'update_employee'])->name('admin.staff.viewstaff.update');
    Route::GET('/admin/staff/viewstaff/{id}', [AdminController::class, 'view_employee'])->name('admin.staff.viewstaff');
    Route::GET('/admin/admin_dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::GET('/admin/quotations', [AdminController::class, 'quotations'])->name('admin.quotations');
    Route::GET('/admin/invoices', [AdminController::class, 'invoices'])->name('admin.invoices');
    Route::GET('/admin/clients', [AdminController::class, 'clients'])->name('admin.clients');
    Route::GET('/admin/viewquotations/{id}', [AdminController::class, 'viewquotations'])->name('admin.viewquotations');
    Route::GET('/admin/viewinvoice/{id}', [AdminController::class, 'viewinvoice'])->name('admin.viewinvoice');
    Route::GET('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::GET('/admin/viewuser/{id}', [AdminController::class, 'viewuser'])->name('admin.viewuser');
    Route::GET('/admin/services', [AdminController::class, 'services'])->name('admin.services');
    Route::get('/quotations/{id}/send-invoice', [QuotationController::class, 'sendInvoice'])->name('quotations.send-invoice');
    Route::GET('/admin/viewservice/{id}', [AdminController::class, 'viewservice'])->name('admin.viewservice');
    Route::GET('/admin/viewsubservice/{id}', [AdminController::class, 'viewsubservice'])->name('admin.viewsubservice');

    //download quotation&invoice PDFs
    Route::get('/admin/download_quotation/{id}', [QuotationController::class, 'quotationPDF'])->name('quotation.pdf');
    Route::get('/admin/download_invoice/{id}', [QuotationController::class, 'invoicePDF'])->name('invoice.pdf');

    //update
    Route::put('/subservices/{subservice_id}', [SubServicesController::class, 'updateSubservice']);
    Route::put('/service/{id}', [ServicesController::class, 'updateService'])->name('service.update');

    //delete
    Route::get('quotations/delete/{id}', [AdminController::class, 'remove'])->name('admin.remove');
    Route::get('invoices/delete/{id}', [AdminController::class, 'removeinvoice'])->name('admin.removeinvoice');
    Route::get('users/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('delete/{id}', [ServicesController::class, 'delete']);
    Route::put('/subservice/{subservice_id}', [SubServicesController::class, 'destroy']);
    Route::put('/updatesubservice/{id}', [SubServicesController::class, 'updateSubservice']);
    Route::put('/option/{id}', [OptionsController::class, 'destroyoption']);

    //Add services, subservices, options Blades

    Route::GET('/admin/addservice', [ServicesController::class, 'addservice'])->name('admin.addservice');
    Route::GET('/admin/editservice/{id}', [ServicesController::class, 'updateService'])->name('admin.editservice');
    Route::GET('/admin/newaddservice', [ServicesController::class, 'newaddservice'])->name('admin.newaddservice');
    Route::GET('/admin/deleteservice', [ServicesController::class, 'deleteservice'])->name('admin.deleteservice');
    Route::get('admin/services/addsubservices/{id}', [SubServicesController::class, 'index'])->name('addsubservices');
    Route::get('admin/services/addoptions/{id}', [OptionsController::class, 'options'])->name('addoptions');

    //Forms
    Route::post('store-form', [ServicesController::class, 'store']);
    Route::post('admin/services/subservice/{id}', [SubServicesController::class, 'store'])->name('subservice.store');
    Route::post('admin/services/addsubservices/{id}', [SubServicesController::class, 'storing'])->name('addsubservices.storing');
    Route::post('admin/services/addoptions/{id}', [OptionsController::class, 'add'])->name('addoptions.add');
    Route::post('/admin/dashboard/careermapping_dashboard', [OccupationsController::class, 'store'])->name('careermapping_dashboard.store');

    //quotations & invoice
    Route::get('/admin/viewoptions/{id}', [OptionsController::class, 'viewoptions']);
    Route::post('/invoices/create/{quotationId}', [InvoiceController::class, 'create'])->name('invoices.create');

    //blogs
    Route::post('storeblog-form', [BlogController::class, 'storeblog']);
    Route::GET('/admin/blog', [BlogController::class, 'blog'])->name('admin.blog');
    Route::GET('/admin/addblog', [BlogController::class, 'addblog'])->name('admin.addblog');
    Route::get('blog/delete/{id}', [BlogController::class, 'destroyblog'])->name('admin.destroyblog');
    Route::put('/blog/{id}', [BlogController::class, 'updateblog'])->name('blog.update');
    Route::GET('/admin/viewblogg/{id}', [BlogController::class, 'viewblogg'])->name('admin.viewblogg');

    //Testimonials
    Route::GET('/admin/testimonials', [TestimonialsController::class, 'testimonials'])->name('admin.testimonials');
    Route::GET('/admin/addtestimony', [TestimonialsController::class, 'addtestimony'])->name('admin.addtestimony');
    Route::post('storetestimony-form', [TestimonialsController::class, 'storetestimony']);
    Route::get('testimonial/delete/{id}', [TestimonialsController::class, 'destroytestimonial'])->name('admin.destroytestimonial');
    Route::put('/testimonial/{id}', [TestimonialsController::class, 'updatetestimonial'])->name('testimonial.update');
    Route::GET('/admin/viewtestimonial/{id}', [TestimonialsController::class, 'viewtestimonial'])->name('admin.viewtestimonial');

    //Career Mapping
    Route::GET('/admin/dashboard/careermapping_dashboard', [OccupationsController::class, 'occupations'])->name('admin.dashboard.careermapping_dashboard');
    Route::delete('/occupations/{occupation}', [OccupationsController::class, 'delete'])->name('occupations.delete');
    Route::GET('/admin/admin_viewoccupations/{occup_id}', [OccupationsController::class, 'showadmin_viewoccupations'])->name('admin.admin_viewoccupations');
    Route::post('addoccupation-form', [OccupationsController::class, 'addoccupation']);
    Route::post('admin/admin_viewoccupations/{occup_id}', [SpecializationsController::class, 'addspecialization'])->name('addspecialization');
    Route::GET('/admin/career_mapping/viewspecialization/{spec_id}', [SpecializationsController::class, 'showadmin_viewspecialization'])->name('admin.career_mapping.viewspecialization');
    Route::delete('/specializations/{specialization}', [SpecializationsController::class, 'delete'])->name('specializations.delete');
    Route::post('/admin/career_mapping/specialization/editspecialization', [SpecializationsController::class, 'updateSpecialization']); //reference
    Route::post('/admin/career_mapping/careersteps/editcareerstep', [CareerStepsController::class, 'updateCareerStep']); //look at
    Route::delete('/careersteps/{careerstep}', [CareerStepsController::class, 'delete'])->name('careersteps.delete');

    Route::post('addcareersteps-form', [CareerStepsController::class, 'addcareersteps']); 

    Route::get('/admin/career_mapping/specialization/edit/{spec_id}', function () {
        return view('/admin/career_mapping/specialization/edit');
    });

    Route::get('/admin/career_mapping/careersteps/edit/{steps_id}', function () {
        return view('/admin/career_mapping/careersteps/edit');
    });

});
//==================================End of Admin Controls==================================================

// Career Maps
Route::GET('career-mapping', [OccupationsController::class, 'showoccupations'])->name('career-mapping');
Route::GET('viewoccupations/{occup_id}', [OccupationsController::class, 'showviewoccupations'])->name('viewoccupations');
Route::get('viewspecialization/{spec_id}', [SpecializationsController::class, 'showviewspecialization'])->name('viewspecialization');

//Service Controller

Route::get('viewservice/{slug}', [ServicesController::class, 'show'])->name('show');
Route::get('services/{slug}', [ServicesController::class, 'display_service_name'])->name('service.show');
Route::get('services/{slug}/{subslug}', [SubServicesController::class, 'display_subservice_name']);


Route::get('viewsubservice/{id}', [SubServicesController::class, 'show'])->name('show');
Route::post('viewsubservice/quote', [QuotationController::class, 'quote'])->name('viewsubservice.quote');

Route::post('contact/contact', [ContactController::class, 'contact'])->name('contact.contact');
Route::post('footer/subscribe', [ContactController::class, 'subscribe'])->name('footer.subscribe');


//Blog
Route::get('blog', [BlogController::class, 'blogpage'])->name('blogpage');
Route::get('viewblog/{id}', [BlogController::class, 'viewblog'])->name('viewblog');

//checkout
Route::get('checkout/checkout', [CheckoutController::class, 'checkout'])->middleware('auth');

Route::post('viewsubservice/check/{subservice_id}', [CheckoutController::class, 'check'])->name('viewsubservice.check');

Route::POST('checkout/credit_card', [PaymentController::class, 'credit_card'])->name('checkout.credit_card')->middleware('auth');

Route::post('/store-selected-options', function (Illuminate\Http\Request $request) {
    $selectedOptions = $request->input('options');
    session(['selectedOptions' => $selectedOptions]);
    return response()->json(['message' => 'Selected options stored successfully']);
})->name('store.selected.options');


require __DIR__ . '/auth.php';