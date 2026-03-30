<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
