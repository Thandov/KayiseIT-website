<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ClientController;
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
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\PostCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Carousel;
use App\Models\Blog;
use App\Models\PostCategories;
use App\Http\Controllers\SubscriptionController;



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
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//Quotations

//Route::post('store-form',[QuotationController::class, 'store']);
Route::post('quote-form', [QuotationController::class, 'quote'])->middleware('auth');

//paypal routes
Route::post('viewsubservice/check/save_invoice', [QuotationController::class, 'save_invoice'])->name('save_invoice');
Route::post('viewsubservice/createQuote', [QuotationController::class, 'createQuote'])->name('viewsubservice.createQuote');
Route::post('/ozow/initiate', 'App\Http\Controllers\OzowPaymentController@initiatePayment')->name('ozow.initiate');


//=================================================Admin ==================================================
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::GET('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    //Route::GET('/dashboard/clients', [ClientController::class, 'index'])->name('dashboard.clients');
    Route::GET('dashboard/clients', [ClientController::class, 'index'])->name('dashboard.clients');
    Route::GET('admin/dashboard/clients/newclient', function () {
        $urlSegments = explode('/', request()->path());
        return view('admin.dashboard.clients.newclient', compact('urlSegments'));
    })->name('admin.dashboard.newclient');
    Route::POST('/dashboard/clients/create', [ClientController::class, 'store'])->name('admin.dashboard.clients.create');
    Route::GET('/dashboard/clients/viewclient/{id}', [ClientController::class, 'show'])->name('dashboard.clients.viewclient');
    Route::POST('/dashboard/clients/update/', [ClientController::class, 'update'])->name('dashboard.clients.update');
    Route::DELETE('/dashboard/clients/delete/{id}', [ClientController::class, 'destroy'])->name('admin.dashboard.clients.delete');
    Route::delete('/dashboard/clients/deleteSelected', [ClientController::class, 'destroy'])->name('admin.dashboard.clients.deleteSelected');

    Route::GET('/dashboard/staff/', [AdminController::class, 'all_employees'])->name('admin.dashboard.staff');
    Route::GET('/dashboard/staff/newstaff', function () {
        return view('admin.staff.newstaff');
    })->name('dashboard.staff.newstaff');
    Route::POST('/dashboard/staff/create', [AdminController::class, 'new_employee'])->name('dashboard.staff.create');
    Route::DELETE('/dashboard/staff/delete/{id}', [AdminController::class, 'delete_employee'])->name('dashboard.staff.delete');
    Route::POST('/dashboard/staff/viewstaff/update/{id}', [AdminController::class, 'update_employee'])->name('dashboard.staff.viewstaff.update');
    Route::GET('/dashboard/staff/viewstaff/{id}', [AdminController::class, 'view_employee'])->name('dashboard.staff.viewstaff');
    Route::GET('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::GET('/dashboard/quotations', [AdminController::class, 'quotations'])->name('dashboard.quotations');
    Route::GET('/dashboard/invoices', [AdminController::class, 'invoices'])->name('dashboard.invoices');
    Route::GET('/dashboard/viewquotations/{id}', [AdminController::class, 'viewquotations'])->name('dashboard.viewquotations');
    Route::GET('/dashboard/viewinvoice/{id}', [AdminController::class, 'viewinvoice'])->name('dashboard.viewinvoice');
    Route::GET('/dashboard/users', [AdminController::class, 'users'])->name('dashboard.users');
    Route::GET('/dashboard/viewuser/{id}', [AdminController::class, 'viewuser'])->name('dashboard.viewuser');
    Route::post('/dashboard/staff/create', [AdminController::class, 'new_employee']);
    Route::DELETE('/dashboard/staff/delete/{id}', [AdminController::class, 'delete_employee'])->name('dashboard.staff.delete');
    Route::POST('/dashboard/staff/{staffName}/update/', [AdminController::class, 'update_employee'])->name('dashboard.staff.viewstaff.update');
    Route::get('/dashboard/staff/{staffName}', [AdminController::class, 'view_employee'])->name('dashboard.staff.viewstaff');

    Route::GET('/dashboard/quotations', [AdminController::class, 'quotations'])->name('dashboard.quotations');
    Route::GET('/dashboard/invoices', [AdminController::class, 'invoices'])->name('dashboard.invoices');
    Route::GET('/dashboard/viewquotations/{id}', [AdminController::class, 'viewquotations'])->name('dashboard.viewquotations');
    Route::GET('/dashboard/viewinvoice/{id}', [AdminController::class, 'viewinvoice'])->name('dashboard.viewinvoice');
    Route::GET('/dashboard/users', [AdminController::class, 'users'])->name('dashboard.users');
    Route::GET('/dashboard/viewuser/{id}', [AdminController::class, 'viewuser'])->name('dashboard.viewuser');
    Route::get('/quotations/{id}/send-invoice', [QuotationController::class, 'sendInvoice'])->name('quotations.send-invoice');

   
    //download quotation&invoice PDFs
    Route::get('/dashboard/download_quotation/{id}', [QuotationController::class, 'quotationPDF'])->name('quotation.pdf');
    Route::get('/dashboard/download_invoice/{id}', [QuotationController::class, 'invoicePDF'])->name('invoice.pdf');

    //update
    Route::put('/service/{id}', [ServicesController::class, 'updateService'])->name('service.update');

    //delete
    Route::get('quotations/delete/{id}', [AdminController::class, 'remove'])->name('dashboard.remove');
    Route::get('invoices/delete/{id}', [AdminController::class, 'removeinvoice'])->name('dashboard.removeinvoice');
    Route::get('users/delete/{id}', [AdminController::class, 'destroy'])->name('dashboard.destroy');
    Route::get('delete/{id}', [ServicesController::class, 'delete']);
    Route::put('/option/{id}', [OptionsController::class, 'destroyoption']);

    //Services
    Route::GET('/dashboard/services/addservice', function () {return view('admin.services.addservice');})->name('dashboard.services.addservice');
    Route::GET('/dashboard/services', [AdminController::class, 'services'])->name('dashboard.services');
    Route::GET('/dashboard/services/{slug}', [AdminController::class, 'viewservice'])->name('dashboard.services.viewservice');
    Route::GET('/dashboard/services/viewservice/{id}', [AdminController::class, 'viewservice'])->name('dashboard.services.viewservice');
    Route::POST('/dashboard/editservice', [ServicesController::class, 'updateService'])->name('dashboard.editservice');
    Route::GET('/dashboard/newaddservice', [ServicesController::class, 'newaddservice'])->name('dashboard.newaddservice');
    Route::POST('/dashboard/services/deleteservice/{id}', [ServicesController::class, 'delete'])->name('dashboard.services.deleteservice');
    Route::get('dashboard/services/addoptions/{id}', [OptionsController::class, 'options'])->name('addoptions');

    //Subservices
    Route::GET('/dashboard/subservices/viewsubservice/{id}', [AdminController::class, 'viewsubservice'])->name('dashboard.subservices.viewsubservice');
    Route::put('/subservices/{subservice_id}', [SubServicesController::class, 'updateSubservice']);
    Route::put('/subservice/{subservice_id}', [SubServicesController::class, 'destroy']);
    Route::put('/updatesubservice', [SubServicesController::class, 'updateSubservice']);
    Route::get('/dashboard/services/addsubservices/{id}', [SubServicesController::class, 'index'])->name('dashboard.services.addsubservices');
    Route::post('/dashboard/services/subservice/{id}', [SubServicesController::class, 'store'])->name('subservice.store');
    Route::POST('/dashboard/subservices/deletesubservice', [SubServicesController::class, 'destroy'])->name('dashboard.subservices.deletesubservice');
    Route::get('services/{slug}/{subslug}', [SubServicesController::class, 'display_subservice_name']);
    Route::POST('dashboard/services/{slug}/addsubservices', [SubServicesController::class, 'store'])->name('dashboard.services.slug.addsubservices');
    Route::get('viewsubservice/{id}', [SubServicesController::class, 'show'])->name('show');

    //Forms
    Route::post('store-form', [ServicesController::class, 'store']);
    Route::post('dashboard/services/addoptions/{id}', [OptionsController::class, 'add'])->name('addoptions.add');
    Route::post('/dashboard/dashboard/careermapping_dashboard', [OccupationsController::class, 'store'])->name('careermapping_dashboard.store');

    //quotations & invoice
    Route::get('/dashboard/viewoptions/{id}', [OptionsController::class, 'viewoptions']);

    //blogs
    Route::GET('/dashboard/blogs', function () {
        $blogs = App\Models\Blog::all();
        return view('admin.blogs', compact('blogs'));
    })->name('dashboard.blogs');
    
    Route::post('/dashboard/blogs/storeblog-form', [BlogController::class, 'storeblog'])->name('dashboard.blogs.storeblog-form');;
    Route::GET('/dashboard/blogs/addblog', [BlogController::class, 'addblog'])->name('dashboard.blogs.addblog');
    Route::GET('/blog', function () {
        $blogs = Blog::all();
        return view('admin.blogs.viewblog', compact('blogs'));
    })->name('dashboard.blogs.blog');
    Route::get('/blog/delete/{id}', [BlogController::class, 'destroyblog'])->name('dashboard.destroyblog');

   // Route::get('/dashboard/edit_blog/{id}', function () {
      //  return view('admin.blogs.viewblog_edit');
  //  })->name('dashboard.blogs.viewblog_edit');
    Route::POST('/dashboard/update_blog/{id}', [BlogController::class, 'updateblog'])->name('dashboard.blogs.viewblog_edit.update_blog');
    Route::GET('/dashboard/blogs/viewblog_edit/{id}', [BlogController::class, 'viewblog_edit'])->name('dashboard.blogs.viewblog_edit');
    Route::GET('/viewblog/{id}', [BlogController::class, 'viewblog'])->name('dashboard.blogs.viewblog');
    Route::post('/upload', [BlogController::class, 'upload'])->name('ckeditor.upload');
    //categories
    Route::get('/categories', [PostCategoriesController::class, 'index'])->name('categories');
    // Route for displaying the list of post categories
    Route::get('/dashboard/blogs/categories', [PostCategoriesController::class, 'index'])->name('dashboard.blogs.categories');
    // Route for showing the form to create a new post category
    Route::get('/dashboard/blogs/categories/create', [PostCategoriesController::class, 'create'])->name('dashboard.blogs.categories.create');
    // Route for deleting the form to create a new post category
    Route::POST('/dashboard/blogs/categories/deleting/{id}', [PostCategoriesController::class, 'destroy'])->name('dashboard.blogs.categories.deleting');
    // Route for storing the newly created post category
    Route::post('/dashboard/blogs/categories', [PostCategoriesController::class, 'store'])->name('dashboard.blogs.categories.store');
    // Route for showing the form to edit an existing post category
    Route::get('/dashboard/blogs/categories/{postCategory}/edit', [PostCategoriesController::class, 'edit'])->name('dashboard.blogs.categories.edit');
     // Route for updating an existing post category
    Route::put('/dashboard/blogs/categories/{postCategory}', [PostCategoriesController::class, 'update'])->name('dashboard.blogs.categories.update');
    // Route for deleting an existing post category
    Route::delete('/dashboard/blogs/categories/{postCategory}', [PostCategoriesController::class, 'destroy'])->name('dashboard.blogs.categories.destroy');


    //Testimonials
    Route::GET('/dashboard/testimonials', [TestimonialsController::class, 'testimonials'])->name('dashboard.testimonials');
    Route::GET('/dashboard/addtestimony', [TestimonialsController::class, 'addtestimony'])->name('dashboard.addtestimony');
    Route::post('storetestimony-form', [TestimonialsController::class, 'storetestimony']);
    Route::get('testimonial/delete/{id}', [TestimonialsController::class, 'destroytestimonial'])->name('dashboard.destroytestimonial');
    Route::put('/testimonial/{id}', [TestimonialsController::class, 'updatetestimonial'])->name('testimonial.update');
    Route::GET('/dashboard/viewtestimonial/{id}', [TestimonialsController::class, 'viewtestimonial'])->name('dashboard.viewtestimonial');

    //Career Mapping
    Route::GET('/dashboard/careermapping', [OccupationsController::class, 'occupations'])->name('dashboard.careermapping');
    Route::delete('/occupations/{occupation}', [OccupationsController::class, 'delete'])->name('occupations.delete');
    Route::GET('/dashboard/admin_viewoccupations/{occup_id}', [OccupationsController::class, 'showadmin_viewoccupations'])->name('dashboard.admin_viewoccupations');
    Route::post('addoccupation-form', [OccupationsController::class, 'addoccupation']);
    Route::post('dashboard/admin_viewoccupations/{occup_id}', [SpecializationsController::class, 'addspecialization'])->name('addspecialization');
    Route::GET('/dashboard/career_mapping/viewspecialization/{spec_id}', [SpecializationsController::class, 'showadmin_viewspecialization'])->name('dashboard.career_mapping.viewspecialization');
    Route::delete('/specializations/{specialization}', [SpecializationsController::class, 'delete'])->name('specializations.delete');
    Route::post('/dashboard/career_mapping/specialization/editspecialization', [SpecializationsController::class, 'updateSpecialization']); //reference
    Route::post('/dashboard/career_mapping/careersteps/editcareerstep', [CareerStepsController::class, 'updateCareerStep']); //look at
    Route::delete('/careersteps/{careerstep}', [CareerStepsController::class, 'delete'])->name('careersteps.delete');

    Route::post('addcareersteps-form', [CareerStepsController::class, 'addcareersteps']);

    Route::get('/dashboard/career_mapping/specialization/edit/{spec_id}', function () {
        return view('/dashboard/career_mapping/specialization/edit');
    })->name('dashboard.career_mapping.specialization.edit');

    Route::get('/dashboard/career_mapping/careersteps/edit/{steps_id}', function () {
        return view('/dashboard/career_mapping/careersteps/edit');
    });
    //Carousel
    Route::GET('admin/carousel', [CarouselController::class, 'index'])->name('admin.carousel');
    Route::GET('/dashboard/carousel', function () {
        $carousels = Carousel::select('id', 'user_id', 'title', 'middletxt', 'btmtxt', 'image')
        ->get();
        return view('admin.dashboard.carousel.carousel', compact('carousels'));
    })->name('admin.dashboard.carousel');
    Route::GET('admin/dashboard/carousel/newcarousel', function () {
        return view('admin.dashboard.carousel.newcarousel');
    })->name('admin.dashboard.carousel.newcarousel');
    Route::POST('admin/dashboard/carousel/create', [CarouselController::class, 'store'])->name('admin.dashboard.carousel.create');
    Route::GET('admin/dashboard/carousel/viewcarousel/{id}', [CarouselController::class, 'show'])->name('admin.dashboard.carousel.viewcarousel');
    Route::POST('admin/dashboard/carousel/viewcarousel/update/', [CarouselController::class, 'update'])->name('admin.dashboard.carousel.viewcarousel.update');
    Route::DELETE('admin/dashboard/carousel/delete/{id}', [CarouselController::class, 'destroy'])->name('admin.dashboard.carousel.delete');
});
//==================================End of Admin Controls==================================================

//Events 
Route::get('Events', function () {
    return view('Events.events');
})->name('events');

Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');


// Career Maps
Route::GET('career-mapping', [OccupationsController::class, 'showoccupations'])->name('career-mapping');
Route::GET('viewoccupations/{occup_id}', [OccupationsController::class, 'showviewoccupations'])->name('viewoccupations');
Route::get('viewspecialization/{spec_id}', [SpecializationsController::class, 'showviewspecialization'])->name('viewspecialization');

//Service Controller

Route::get('/viewservice/{slug}', [ServicesController::class, 'show'])->name('show');
Route::get('/services/{slug}', [ServicesController::class, 'display_service_name'])->name('service.show');


Route::post('viewsubservice/quote', [QuotationController::class, 'quote'])->name('viewsubservice.quote');

Route::post('contact/contact', [ContactController::class, 'contact'])->name('contact.contact');
Route::post('footer/subscribe', [ContactController::class, 'subscribe'])->name('footer.subscribe');


//Blog
Route::get('/blogs', function () {
    $blogs = App\Models\Blog::select('id', 'icon', 'title', 'category_no')->get();
    return view('blogs', compact('blogs'));
})->name('blogs');
Route::get('/blogs/displayblog/{id}', function ($id) {
    $blog = App\Models\Blog::where('id', $id)->first();
    return view('blogs.displayblog', compact('blog'));
})->name('blogs.displayblog');

//checkout
Route::get('checkout/checkout', [CheckoutController::class, 'checkout'])->middleware('auth');

Route::get('viewsubservice/check/{subservice_id}', [CheckoutController::class, 'check'])->name('viewsubservice.check');

Route::POST('checkout/credit_card', [PaymentController::class, 'credit_card'])->name('checkout.credit_card')->middleware('auth');

Route::post('/store-selected-options', function (Illuminate\Http\Request $request) {
    $selectedOptions = $request->input('options');
    session(['selectedOptions' => $selectedOptions]);
    return response()->json(['message' => 'Selected options stored successfully']);
})->name('store.selected.options');

require __DIR__ . '/auth.php';