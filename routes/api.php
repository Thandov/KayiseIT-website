<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\InternshipProgram;
use App\Http\Controllers\Api\V1\AnnouncementApiController;
use App\Http\Controllers\Api\V1\BlogController as ApiBlogController;
use App\Http\Controllers\Api\V1\CaseStudyController as ApiCaseStudyController;
use App\Http\Controllers\Api\V1\ClientApiController;
use App\Http\Controllers\Api\V1\HealthController as ApiHealthController;
use App\Http\Controllers\Api\V1\InvoiceController as ApiInvoiceController;
use App\Http\Controllers\Api\V1\ProgramController as ApiProgramController;
use App\Http\Controllers\Api\V1\QuotationApiController;
use App\Http\Controllers\Api\V1\ServiceController as ApiServiceController;
use App\Http\Controllers\Api\V1\StaffController as ApiStaffController;
use App\Http\Controllers\Api\V1\UserController as ApiUserController;

Route::get('/programs/{program}/form-fields', function (InternshipProgram $program) {
    abort_unless($program->is_active, 404);

    $values = [];
    if (auth()->check()) {
        $user = auth()->user();
        $values = [
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'phone' => $user->phone,
            'cellphone' => $user->phone,
            'id_number' => $user->id_number,
            'age' => $user->age,
            'address' => $user->address,
            'province' => $user->province,
            'high_school' => $user->high_school,
            'year_of_completion' => $user->year_of_completion,
            'qualification' => $user->qualification,
            'year_obtained' => $user->year_obtained,
            'institution' => $user->institution,
        ];
    }

    return response()->json([
        'program_id' => $program->id,
        'program_name' => $program->name,
        'allows_enquiry' => $program->allows_enquiry,
        'html' => view('components.program-form-fields', [
            'groupedFields' => $program->getGroupedFormFields(),
            'values' => $values,
        ])->render(),
    ]);
})->whereNumber('program');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned to the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/chatbot/opportunities', function () {
    $today = now()->toDateString();

    $programs = InternshipProgram::query()
        ->active()
        ->whereDate('recruitment_end_date', '>=', $today)
        ->orderBy('recruitment_end_date')
        ->orderByDesc('created_at')
        ->limit(5)
        ->pluck('name')
        ->filter()
        ->values();

    if ($programs->isEmpty()) {
        return response()->json([
            'has_opportunities' => false,
            'names' => [],
            'response' => 'There are currently no open opportunities right now. Please check our Opportunities page again soon for new openings.'
        ]);
    }

    return response()->json([
        'has_opportunities' => true,
        'names' => $programs->all(),
        'response' => 'Yes, we currently have open opportunities: ' . $programs->implode(', ') . '. Visit the Opportunities page to view details and apply.'
    ]);
});

/*
|--------------------------------------------------------------------------
| Public + authenticated API v1
|--------------------------------------------------------------------------
|
| Versioned JSON API for clients that need site content. Public GETs are
| throttled by IP. Private routes use Sanctum bearer tokens.
|
*/

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('/health', [ApiHealthController::class, 'show'])->name('health');

    Route::middleware('throttle:api-public')->group(function () {
        Route::get('/services', [ApiServiceController::class, 'index'])->name('services.index');
        Route::get('/services/{slug}', [ApiServiceController::class, 'show'])->name('services.show');

        Route::get('/blogs', [ApiBlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/{id}', [ApiBlogController::class, 'show'])->whereNumber('id')->name('blogs.show');

        Route::get('/programs', [ApiProgramController::class, 'index'])->name('programs.index');
        Route::get('/programs/{id}', [ApiProgramController::class, 'show'])->whereNumber('id')->name('programs.show');

        Route::get('/case-studies', [ApiCaseStudyController::class, 'index'])->name('case-studies.index');
        Route::get('/case-studies/{slug}', [ApiCaseStudyController::class, 'show'])->name('case-studies.show');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [ApiUserController::class, 'show'])->name('user');

        Route::get('/staff', [ApiStaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/{id}', [ApiStaffController::class, 'show'])->whereNumber('id')->name('staff.show');

        Route::get('/clients', [ClientApiController::class, 'index'])->name('clients.index');
        Route::get('/clients/{id}', [ClientApiController::class, 'show'])->whereNumber('id')->name('clients.show');

        Route::get('/announcements', [AnnouncementApiController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/{id}', [AnnouncementApiController::class, 'show'])->whereNumber('id')->name('announcements.show');

        Route::get('/invoices', [ApiInvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{id}', [ApiInvoiceController::class, 'show'])->whereNumber('id')->name('invoices.show');

        Route::get('/quotations', [QuotationApiController::class, 'index'])->name('quotations.index');
        Route::get('/quotations/{id}', [QuotationApiController::class, 'show'])->whereNumber('id')->name('quotations.show');
    });
});

/*
|--------------------------------------------------------------------------
| Twilio IVR Phone Agent Routes
|--------------------------------------------------------------------------
|
| These routes handle incoming calls and IVR interactions
| Note: These should NOT have auth middleware as Twilio calls them directly
|
*/

use App\Http\Controllers\TwilioIvrController;

Route::prefix('twilio')->group(function () {
    // Incoming call handler
    Route::post('/ivr/incoming', [TwilioIvrController::class, 'handleIncomingCall'])->name('twilio.ivr.incoming');

    // Menu selection processor
    Route::post('/ivr/process', [TwilioIvrController::class, 'processMenuSelection'])->name('twilio.ivr.process');

    // Follow-up handler
    Route::post('/ivr/followup', [TwilioIvrController::class, 'handleFollowUp'])->name('twilio.ivr.followup');

    // Status callback
    Route::post('/status', [TwilioIvrController::class, 'statusCallback'])->name('twilio.status.callback');

    // Spoken input handler (for future voice recognition)
    Route::post('/ivr/speech', [TwilioIvrController::class, 'handleSpokenInput'])->name('twilio.ivr.speech');
})->withoutMiddleware(['api']);
