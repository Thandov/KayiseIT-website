<?php

namespace App\Http\Controllers;

use App\Services\TwilioService;
use App\Services\ChatbotResponseService;
use App\Models\CallLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Twilio\TwiML\VoiceResponse;

class TwilioIvrController extends Controller
{
    protected $twilioService;
    protected $chatbotService;

    public function __construct(TwilioService $twilioService, ChatbotResponseService $chatbotService)
    {
        $this->twilioService = $twilioService;
        $this->chatbotService = $chatbotService;
    }

    /**
     * Handle incoming call - send welcome message and menu
     */
    public function handleIncomingCall(Request $request): Response
    {
        // Log incoming call
        \Log::info('Incoming call from: ' . $request->input('From'));

        $response = $this->twilioService->getMenuResponse();

        return response($response, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Process IVR menu selection
     */
    public function processMenuSelection(Request $request): Response
    {
        $digits = $request->input('Digits', '');
        $attemptNumber = (int) $request->input('attempt_number', 1);

        $menuOptions = config('twilio.menu_options');

        // Validate digit input
        if (empty($digits) || !isset($menuOptions[$digits])) {
            // Invalid input - repeat menu
            if ($attemptNumber >= config('twilio.max_ivr_attempts')) {
                // Too many attempts - transfer to agent
                \Log::warning('Max IVR attempts reached, transferring to agent');
                return response($this->twilioService->transferToAgent(), 200, ['Content-Type' => 'application/xml']);
            }

            // Repeat menu
            $response = $this->twilioService->getMenuResponse(
                "Sorry, I didn't understand that input. Please try again.",
                $attemptNumber + 1
            );

            return response($response, 200, ['Content-Type' => 'application/xml']);
        }

        // Get selected option
        $selectedOption = $menuOptions[$digits];
        $intent = $selectedOption['intent'];

        // Handle transfer to agent
        if ($intent === 'transfer') {
            \Log::info('User selected to speak to agent');
            return response($this->twilioService->transferToAgent(), 200, ['Content-Type' => 'application/xml']);
        }

        // Get AI response for the selected intent
        $aiResponse = $this->chatbotService->getResponseByIntent($intent);

        // Create response with the AI message and offer menu options
        $response = new VoiceResponse();

        $response->say(
            $aiResponse,
            [
                'voice' => config('twilio.kayise_voice'),
                'language' => config('twilio.kayise_language')
            ]
        );

        // Ask if they need anything else or want to transfer
        $response->say(
            'Would you like to hear more options? Press 0 to speak to an agent or any other key to return to the menu.',
            [
                'voice' => config('twilio.kayise_voice'),
                'language' => config('twilio.kayise_language')
            ]
        );

        // Gather input for next action
        $gather = $response->gather([
            'numDigits' => 1,
            'action' => route('twilio.ivr.followup'),
            'method' => 'POST',
            'timeout' => 5,
        ]);

        // If no input, redirect to main menu
        $redirect = new VoiceResponse();
        $redirect->redirect(route('twilio.ivr.handle'));

        return response($response, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Handle follow-up after response
     */
    public function handleFollowUp(Request $request): Response
    {
        $digits = $request->input('Digits', '');

        // If user wants to speak to agent
        if ($digits === '0') {
            return response($this->twilioService->transferToAgent(), 200, ['Content-Type' => 'application/xml']);
        }

        // Otherwise, return to menu
        $response = $this->twilioService->getMenuResponse();

        return response($response, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Handle call status callback from Twilio
     */
    public function statusCallback(Request $request): Response
    {
        $callSid = $request->input('CallSid');
        $callStatus = $request->input('CallStatus');
        $to = $request->input('To');
        $from = $request->input('From');
        $duration = $request->input('CallDuration', 0);

        // Log call details
        \Log::info('Call Status: ' . $callStatus, [
            'call_sid' => $callSid,
            'from' => $from,
            'to' => $to,
            'duration' => $duration,
        ]);

        // Store call record in database
        try {
            $callLog = CallLog::where('call_sid', $callSid)->first();
            
            if ($callLog) {
                $callLog->update([
                    'status' => $callStatus,
                    'duration' => (int) $duration,
                    'ended_at' => now(),
                ]);
            } else {
                CallLog::create([
                    'call_sid' => $callSid,
                    'from' => $from,
                    'to' => $to,
                    'status' => $callStatus,
                    'duration' => (int) $duration,
                    'started_at' => now()->subSeconds((int) $duration),
                    'ended_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Failed to save call log: ' . $e->getMessage());
        }

        return response('', 200);
    }

    /**
     * Handle user spoken input (for future Dialogflow integration)
     * This endpoint can be extended to handle voice transcription
     */
    public function handleSpokenInput(Request $request): Response
    {
        $speechResult = $request->input('SpeechResult', '');
        $confidence = $request->input('Confidence', 0);

        \Log::info('Speech Input: ' . $speechResult . ' (Confidence: ' . $confidence . ')');

        if ($confidence > 0.5) {
            $aiResponse = $this->chatbotService->getResponse($speechResult);
        } else {
            $aiResponse = "I didn't catch that clearly. Please try again or press 0 to speak to an agent.";
        }

        $response = new VoiceResponse();
        $response->say($aiResponse, [
            'voice' => config('twilio.kayise_voice'),
            'language' => config('twilio.kayise_language')
        ]);

        $gather = $response->gather([
            'numDigits' => 1,
            'action' => route('twilio.ivr.followup'),
            'method' => 'POST',
            'timeout' => 5,
        ]);

        return response($response, 200, ['Content-Type' => 'application/xml']);
    }
}
