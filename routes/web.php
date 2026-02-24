<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsinaRegistrationController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SubServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentPortalController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OccupationsController;
use App\Http\Controllers\SpecializationsController;
use App\Http\Controllers\CareerStepsController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PostCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Carousel;
use App\Models\Blog;
use App\Models\InternshipApplication;
use App\Models\PostCategories;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\SitemapController;
use App\Models\Service;



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

// Route::get('/', function () {
//     return view('home');
// })->name('home');

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

Route::get('opportunities', function () {
    // Internship Programs removed - using Interns & Learners instead
    return view('opportunities');
})->name('opportunities');

// Public Announcements Page
Route::get('announcements', [App\Http\Controllers\AnnouncementController::class, 'publicIndex'])->name('announcements');

// USINA registration
Route::get('/usina', [UsinaRegistrationController::class, 'create'])->name('usina.create');
Route::post('/usina/register', [UsinaRegistrationController::class, 'store'])->name('usina.store');

Route::GET('services', [ServicesController::class, 'services'])->name('services');

Route::GET('gallery', [GalleryController::class, 'gallery'])->name('gallery');

//terms and conditions
Route::get('terms', function () {
    return view('terms');
})->name('terms');

//Drone registration
Route::get('drones', function () {
    return view('drone_application/drones');
})->name('drones');
Route::get('drone_application/drone_reg', function () {
    return view('drone_application/drone_reg');
});

Route::post('drone_application/drone_reg', [ApplicationsController::class, 'drone_registration'])->name('drone_application');
Route::post('drone_application/summary', [ApplicationsController::class, 'summary']);

//Internship application
Route::get('internship', function () {
    return view('internships/internship');
})->name('internship');

Route::get('internship/internship_application', function () {
$existingApplication = InternshipApplication::where('user_id', auth()->id())->exists();
return view('internships/internship_application', compact('existingApplication'));
})->middleware('auth')->name('internship_application');

Route::post('/apply', [ApplicationsController::class, 'store'])->name('apply.store');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

// LMS Certification (public) — request certificate by ID; eligibility from learner CSVs
Route::get('lms/certification', [CertificationController::class, 'showForm'])->name('certification.form');
Route::post('lms/certification', [CertificationController::class, 'submit'])->name('certification.submit');
Route::get('lms/certification/success', [CertificationController::class, 'success'])->name('certification.success');
Route::get('lms/certification/download', [CertificationController::class, 'download'])->name('certification.download')->middleware('throttle:10,1');

// Student Portal - students get redirected here on login
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/portal', [StudentPortalController::class, 'index'])->name('portal');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::GET('profile/viewQuotation/{quote}', [QuotationController::class, 'quotationPDFview'])->name('profile.viewQuotation.quote');
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
Route::group(['middleware' => ['auth']], function () {
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

    // Staff CRUD Routes
    Route::GET('/dashboard/staff', [AdminController::class, 'all_employees'])->name('admin.dashboard.staff');
    Route::POST('/dashboard/staff/create', [AdminController::class, 'new_employee'])->name('dashboard.staff.create');
    Route::GET('/dashboard/staff/{id}', [AdminController::class, 'view_employee'])->name('dashboard.staff.view');
    Route::PUT('/dashboard/staff/{id}', [AdminController::class, 'update_employee'])->name('dashboard.staff.update');
    Route::DELETE('/dashboard/staff/delete/{id}', [AdminController::class, 'delete_employee'])->name('dashboard.staff.delete');
    
    Route::GET('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::GET('/dashboard/quotations', [AdminController::class, 'quotations'])->name('dashboard.quotations');
    Route::GET('/dashboard/invoices', [AdminController::class, 'invoices'])->name('dashboard.invoices');
    Route::GET('/dashboard/viewquotations/{id}', [AdminController::class, 'viewquotations'])->name('dashboard.viewquotations');
    Route::GET('/dashboard/viewinvoice/{id}', [AdminController::class, 'viewinvoice'])->name('dashboard.viewinvoice');
    Route::GET('/dashboard/users', [AdminController::class, 'users'])->name('dashboard.users');
    Route::GET('/dashboard/viewuser/{id}', [AdminController::class, 'viewuser'])->name('dashboard.viewuser');
    Route::GET('/dashboard/viewapplications/{id}', [AdminController::class, 'viewapplications'])->name('dashboard.viewapplications');
    Route::GET('/dashboard/viewinternship/{id}', [AdminController::class, 'viewinternship'])->name('dashboard.viewinternship');
    Route::GET('/dashboard/viewinternship/{id}/download/{type}', [AdminController::class, 'downloadinternshipDocs'])->name('internship.download');

    // Applications CRUD Routes
    Route::GET('/dashboard/applications', [AdminController::class, 'applications'])->name('dashboard.applications');
    Route::GET('/dashboard/applications/create', [AdminController::class, 'createApplication'])->name('dashboard.applications.create');
    Route::POST('/dashboard/applications/store', [AdminController::class, 'storeApplication'])->name('dashboard.applications.store');
    Route::GET('/dashboard/applications/edit/{id}', [AdminController::class, 'editApplication'])->name('dashboard.applications.edit');
    Route::PUT('/dashboard/applications/update/{id}', [AdminController::class, 'updateApplication'])->name('dashboard.applications.update');
    Route::DELETE('/dashboard/applications/delete/{id}', [AdminController::class, 'deleteApplication'])->name('dashboard.applications.delete');
    Route::DELETE('/dashboard/applications/deleteSelected', [AdminController::class, 'deleteSelectedApplications'])->name('admin.dashboard.applications.deleteSelected');
    
    // Programs CRUD Routes (formerly Internships)
    Route::GET('/dashboard/programs', [AdminController::class, 'programs'])->name('dashboard.programs');
    Route::GET('/dashboard/programs/create', [AdminController::class, 'createProgram'])->name('dashboard.programs.create');
    Route::POST('/dashboard/programs/store', [AdminController::class, 'storeProgram'])->name('dashboard.programs.store');
    Route::GET('/dashboard/programs/view/{id}', [AdminController::class, 'viewProgram'])->name('dashboard.programs.view');
    Route::GET('/dashboard/programs/edit/{id}', [AdminController::class, 'editProgram'])->name('dashboard.programs.edit');
    Route::PUT('/dashboard/programs/update/{id}', [AdminController::class, 'updateProgram'])->name('dashboard.programs.update');
    Route::DELETE('/dashboard/programs/delete/{id}', [AdminController::class, 'deleteProgram'])->name('dashboard.programs.delete');
    Route::DELETE('/dashboard/programs/deleteSelected', [AdminController::class, 'deleteSelectedPrograms'])->name('admin.dashboard.programs.deleteSelected');
    
    // Keep old internship routes for backward compatibility (redirect to programs)
    Route::GET('/dashboard/internships', function() { return redirect()->route('dashboard.programs'); })->name('dashboard.internships');
    
    // Interns & Learners CRUD Routes
    Route::GET('/dashboard/interns-learners', [AdminController::class, 'internsLearners'])->name('dashboard.interns-learners');
    Route::GET('/dashboard/interns-learners/create', [AdminController::class, 'createInternLearner'])->name('dashboard.interns-learners.create');
    Route::POST('/dashboard/interns-learners/store', [AdminController::class, 'storeInternLearner'])->name('dashboard.interns-learners.store');
    Route::GET('/dashboard/interns-learners/view/{id}', [AdminController::class, 'viewInternLearner'])->name('dashboard.interns-learners.view');
    Route::GET('/dashboard/interns-learners/edit/{id}', [AdminController::class, 'editInternLearner'])->name('dashboard.interns-learners.edit');
    Route::PUT('/dashboard/interns-learners/update/{id}', [AdminController::class, 'updateInternLearner'])->name('dashboard.interns-learners.update');
    Route::DELETE('/dashboard/interns-learners/delete/{id}', [AdminController::class, 'deleteInternLearner'])->name('dashboard.interns-learners.delete');
    Route::DELETE('/dashboard/interns-learners/deleteSelected', [AdminController::class, 'deleteSelectedInternsLearners'])->name('admin.dashboard.interns-learners.deleteSelected');
    
    // Case Studies CRUD Routes
    Route::GET('/dashboard/case-studies', [CaseStudyController::class, 'index'])->name('dashboard.case-studies.index');
    Route::GET('/dashboard/case-studies/create', [CaseStudyController::class, 'create'])->name('dashboard.case-studies.create');
    Route::POST('/dashboard/case-studies', [CaseStudyController::class, 'store'])->name('dashboard.case-studies.store');
    Route::GET('/dashboard/case-studies/{id}', [CaseStudyController::class, 'show'])->name('dashboard.case-studies.show');
    Route::GET('/dashboard/case-studies/{id}/edit', [CaseStudyController::class, 'edit'])->name('dashboard.case-studies.edit');
    Route::PUT('/dashboard/case-studies/{id}', [CaseStudyController::class, 'update'])->name('dashboard.case-studies.update');
    Route::DELETE('/dashboard/case-studies/{id}', [CaseStudyController::class, 'destroy'])->name('dashboard.case-studies.destroy');
    
    // In-House Products Route
    Route::GET('/dashboard/products', function () {
        $products = App\Models\Product::ordered()->get();
        $isAdmin = true;
        $pageTitle = 'In-House Products';
        return view('admin.dashboard.products.index', compact('products', 'isAdmin', 'pageTitle'));
    })->name('dashboard.products');
    
    // Toggle product visibility on frontend
    Route::POST('/dashboard/products/{id}/toggle', function ($id) {
        $product = App\Models\Product::findOrFail($id);
        $product->show_on_frontend = !$product->show_on_frontend;
        $product->save();
        return response()->json([
            'success' => true,
            'show_on_frontend' => $product->show_on_frontend,
            'message' => $product->show_on_frontend ? 'Product will be shown on frontend' : 'Product will be hidden on frontend'
        ]);
    })->name('dashboard.products.toggle');
    
    // ==================== PARTNERS CRUD ROUTES ====================
    Route::GET('/dashboard/partners', [AdminController::class, 'partners'])->name('dashboard.partners');
    Route::GET('/dashboard/partners/create', [AdminController::class, 'createPartner'])->name('dashboard.partners.create');
    Route::POST('/dashboard/partners', [AdminController::class, 'storePartner'])->name('dashboard.partners.store');
    Route::GET('/dashboard/partners/{id}', [AdminController::class, 'viewPartner'])->name('dashboard.partners.view');
    Route::GET('/dashboard/partners/{id}/edit', [AdminController::class, 'editPartner'])->name('dashboard.partners.edit');
    Route::PUT('/dashboard/partners/{id}', [AdminController::class, 'updatePartner'])->name('dashboard.partners.update');
    Route::DELETE('/dashboard/partners/{id}', [AdminController::class, 'deletePartner'])->name('dashboard.partners.delete');
    Route::DELETE('/dashboard/partners', [AdminController::class, 'deleteSelectedPartners'])->name('dashboard.partners.deleteSelected');
    
    // ==================== SERVICES CRUD ROUTES ====================
    Route::DELETE('/dashboard/services/deleteSelected', [AdminController::class, 'deleteSelectedServices'])->name('admin.dashboard.services.deleteSelected');
    
    // Route to manually add KAYISE IT services to database
    Route::GET('/dashboard/services/add-all-services', function () {
        $services = [
            [
                'name' => 'Software Development',
                'slug' => 'software_development',
                'description' => 'Custom software solutions tailored to your business needs. We develop enterprise applications, APIs, and integration solutions that drive efficiency and growth.',
                'price' => 0.00,
                'icon' => 'software.svg',
                'service_id' => 'S001',
                'service_type' => 'dynamic',
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web_development',
                'description' => 'Our company specializes in creating contemporary and adaptable websites. You can view our available packages listed below.',
                'price' => 0.00,
                'icon' => 'web.svg',
                'service_id' => 'S002',
                'service_type' => 'dynamic',
            ],
            [
                'name' => 'IT Consulting',
                'slug' => 'it_consulting',
                'description' => 'Strategic IT consulting services to help your business optimize technology infrastructure, plan digital transformation, and maximize operational efficiency.',
                'price' => 0.00,
                'icon' => 'tele.svg',
                'service_id' => 'S003',
                'service_type' => 'dynamic',
            ],
            [
                'name' => 'Tech Support',
                'slug' => 'tech_support',
                'description' => 'We offer support to companies and customers when they have problems using tech equipment, software, and/or services.',
                'price' => 0.00,
                'icon' => 'tech.svg',
                'service_id' => 'S004',
                'service_type' => 'dynamic',
            ],
            [
                'name' => '4IR Skills Training',
                'slug' => '4ir_skills_training',
                'description' => 'We provide 4th Industrial Revolution skills training programmes',
                'price' => 0.00,
                'icon' => '4ir.svg',
                'service_id' => 'S005',
                'service_type' => 'dynamic',
            ],
            [
                'name' => 'Cloud Hosting Services',
                'slug' => 'cloud_hosting_services',
                'description' => 'Comprehensive cloud hosting solutions on Microsoft Azure, Amazon AWS, and other leading platforms. We help you migrate, manage, and optimize your cloud infrastructure.',
                'price' => 0.00,
                'icon' => 'saas.svg',
                'service_id' => 'S006',
                'service_type' => 'dynamic',
            ],
            [
                'name' => 'Data Backup & Recovery',
                'slug' => 'data_backup_recovery',
                'description' => 'Professional data backup, recovery, and cleaning services. We protect your critical data with automated backups and provide fast recovery solutions when disaster strikes.',
                'price' => 0.00,
                'icon' => 'brand.svg',
                'service_id' => 'S007',
                'service_type' => 'dynamic',
            ],
            [
                'name' => 'Networking',
                'slug' => 'networking',
                'description' => 'Complete networking solutions including network design, installation, configuration, and maintenance. We ensure reliable connectivity and optimal performance for your business.',
                'price' => 0.00,
                'icon' => 'tele.svg',
                'service_id' => 'S008',
                'service_type' => 'dynamic',
            ],
        ];

        $added = 0;
        $skipped = 0;

        foreach ($services as $serviceData) {
            $exists = DB::table('services')
                ->where('slug', $serviceData['slug'])
                ->orWhere('service_id', $serviceData['service_id'])
                ->exists();
            
            if (!$exists) {
                DB::table('services')->insert([
                    'name' => $serviceData['name'],
                    'slug' => $serviceData['slug'],
                    'description' => $serviceData['description'],
                    'price' => $serviceData['price'],
                    'icon' => $serviceData['icon'],
                    'service_id' => $serviceData['service_id'],
                    'service_type' => $serviceData['service_type'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $added++;
            } else {
                $skipped++;
            }
        }

        return redirect()->route('dashboard.services')
            ->with('success', "Services inserted successfully! Added: {$added}, Skipped: {$skipped}");
    })->name('dashboard.services.add-all');

    Route::GET('/dashboard/quotations', [AdminController::class, 'quotations'])->name('dashboard.quotations');
    Route::GET('/dashboard/invoices', [AdminController::class, 'invoices'])->name('dashboard.invoices');
    Route::GET('/dashboard/viewquotations/{id}', [AdminController::class, 'viewquotations'])->name('dashboard.viewquotations');
    Route::GET('/dashboard/viewinvoice/{id}', [AdminController::class, 'viewinvoice'])->name('dashboard.viewinvoice');
    Route::GET('/dashboard/users', [AdminController::class, 'users'])->name('dashboard.users');
    Route::GET('/dashboard/viewuser/{id}', [AdminController::class, 'viewuser'])->name('dashboard.viewuser');
    Route::get('/quotations/{id}/send-invoice', [QuotationController::class, 'sendInvoice'])->name('quotations.send-invoice');

    //Gallery
    Route::GET('/dashboard/gallery', [GalleryController::class, 'index'])->name('dashboard.gallery');
    Route::POST('/dashboard/gallery/upload', [GalleryController::class, 'store'])->name('dashboard.gallery.upload');
    Route::POST('/dashboard/gallery/category', [GalleryController::class, 'storeCategory'])->name('dashboard.gallery.category.store');
    Route::PUT('/dashboard/gallery/{id}', [GalleryController::class, 'update'])->name('dashboard.gallery.update');
    Route::DELETE('/dashboard/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('dashboard.gallery.delete');
    Route::POST('/dashboard/gallery/delete-selected', [GalleryController::class, 'bulkDestroy'])->name('dashboard.gallery.deleteSelected');
    Route::DELETE('/dashboard/gallery/category/{id}', [GalleryController::class, 'destroyCategory'])->name('dashboard.gallery.delete-category');
    Route::POST('/dashboard/gallery/{id}/set-featured', [GalleryController::class, 'setFeatured'])->name('dashboard.gallery.set-featured');
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
    Route::GET('/dashboard/services/viewservice/{id}', [AdminController::class, 'viewservice'])->name('dashboard.services.viewservice');
    Route::POST('/dashboard/editservice', [ServicesController::class, 'updateService'])->name('dashboard.editservice');
    Route::PUT('/dashboard/services/update/{id}', [ServicesController::class, 'updateService'])->name('dashboard.services.update');
    Route::GET('/dashboard/newaddservice', [ServicesController::class, 'newaddservice'])->name('dashboard.newaddservice');
    Route::POST('/dashboard/services/deleteservice/{id}', [ServicesController::class, 'delete'])->name('dashboard.services.deleteservice');
    Route::DELETE('/dashboard/services/delete/{id}', [ServicesController::class, 'delete'])->name('dashboard.services.delete');
    Route::get('dashboard/services/addoptions/{id}', [OptionsController::class, 'options'])->name('addoptions');
    Route::GET('/dashboard/services/{slug}', [AdminController::class, 'viewservice'])->name('dashboard.services.viewservice.slug');

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
    Route::post('store-form', [ServicesController::class, 'store'])->name('storeservice');
    Route::post('dashboard/services/addoptions/{id}', [OptionsController::class, 'add'])->name('addoptions.add');
    Route::post('/dashboard/dashboard/careermapping_dashboard', [OccupationsController::class, 'store'])->name('careermapping_dashboard.store');

    //quotations & invoice
    Route::get('/dashboard/viewoptions/{id}', [OptionsController::class, 'viewoptions']);

    //blogs
    Route::GET('/dashboard/blogs', function () {
        $blogs = App\Models\Blog::all();
        $isAdmin = true;
        $pageTitle = 'Blogs Management';
        return view('admin.dashboard.blogs.index', compact('blogs', 'isAdmin', 'pageTitle'));
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
    Route::GET('/dashboard/careermapping', function () {
        try {
            $occupations = App\Models\Occupations::all();
        } catch (\Exception $e) {
            $occupations = collect();
        }
        $isAdmin = true;
        $pageTitle = 'Career Mapping';
        return view('admin.dashboard.careermapping.index', compact('occupations', 'isAdmin', 'pageTitle'));
    })->name('dashboard.careermapping');
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
    //Carousel CRUD Routes
    Route::GET('/dashboard/carousel', [CarouselController::class, 'index'])->name('admin.dashboard.carousel');
    Route::GET('/dashboard/carousel/create', [CarouselController::class, 'create'])->name('admin.dashboard.carousel.create');
    Route::POST('/dashboard/carousel', [CarouselController::class, 'store'])->name('admin.dashboard.carousel.store');
    Route::GET('/dashboard/carousel/{id}', [CarouselController::class, 'show'])->name('admin.dashboard.carousel.show');
    Route::GET('/dashboard/carousel/{id}/edit', [CarouselController::class, 'edit'])->name('admin.dashboard.carousel.edit');
    Route::PUT('/dashboard/carousel/{id}', [CarouselController::class, 'update'])->name('admin.dashboard.carousel.update');
    Route::DELETE('/dashboard/carousel/{id}', [CarouselController::class, 'destroy'])->name('admin.dashboard.carousel.destroy');
    
    //Announcements CRUD Routes
    Route::GET('/dashboard/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('admin.dashboard.announcements.index');
    Route::GET('/dashboard/announcements/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('admin.dashboard.announcements.create');
    Route::POST('/dashboard/announcements', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('admin.dashboard.announcements.store');
    Route::GET('/dashboard/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('admin.dashboard.announcements.show');
    Route::GET('/dashboard/announcements/{id}/edit', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('admin.dashboard.announcements.edit');
    Route::PUT('/dashboard/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('admin.dashboard.announcements.update');
    Route::DELETE('/dashboard/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('admin.dashboard.announcements.destroy');
    
    // Legacy routes for backward compatibility
    Route::GET('admin/carousel', [CarouselController::class, 'index'])->name('admin.carousel');
    Route::GET('admin/dashboard/carousel/newcarousel', [CarouselController::class, 'create'])->name('admin.dashboard.carousel.newcarousel');
    Route::POST('admin/dashboard/carousel/create', [CarouselController::class, 'store'])->name('admin.dashboard.carousel.create.legacy');
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
Route::get('services/{slug}', [ServicesController::class, 'display_service_name'])->name('service.show');


Route::post('viewsubservice/quote', [QuotationController::class, 'quote'])->name('viewsubservice.quote');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('contact/contact', [ContactController::class, 'contact'])->name('contactsubmit');
Route::post('footer/subscribe', [ContactController::class, 'subscribe'])->name('footer.subscribe');


//Blog
Route::get('/blogs', function () {
    $blogs = App\Models\Blog::select('id', 'icon', 'title', 'category_no')->get();
    return view('blogs', compact('blogs'));
})->name('blogs');

// QR Code Generator
Route::get('/qr-code-generator', function () {
    return view('qr-code-generator');
})->name('qr-code-generator');
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

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

require __DIR__ . '/auth.php';