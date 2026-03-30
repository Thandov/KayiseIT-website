<?php

namespace App\Services;

use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class TwilioService
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->config = config('twilio');
        $this->client = new Client(
            $this->config['account_sid'],
            $this->config['auth_token']
        );
    }

    /**
     * Create a TwiML response for IVR
     */
    public function createIvrResponse(string $prompt, array $gatherOptions = []): VoiceResponse
    {
        $response = new VoiceResponse();

        // Say the prompt
        $response->say(
            $prompt,
            [
                'voice' => $this->config['kayise_voice'],
                'language' => $this->config['kayise_language']
            ]
        );

        // Gather DTMF input (1-5 keys)
        $gather = $response->gather([
            'numDigits' => $gatherOptions['numDigits'] ?? 1,
            'action' => $gatherOptions['action'] ?? route('twilio.ivr.process'),
            'method' => 'POST',
            'timeout' => $gatherOptions['timeout'] ?? 5,
            'finishOnKey' => '#',
        ]);

        // If no input received, add help text
        if (isset($gatherOptions['helpText'])) {
            $gather->say(
                $gatherOptions['helpText'],
                [
                    'voice' => $this->config['kayise_voice'],
                    'language' => $this->config['kayise_language']
                ]
            );
        }

        return $response;
    }

    /**
     * Create a welcome message with menu
     */
    public function getWelcomeMessage(): string
    {
        $menuOptions = $this->config['menu_options'];
        $options = implode(', ', array_map(
            fn($key, $option) => "Press $key for {$option['label']}",
            array_keys($menuOptions),
            array_values($menuOptions)
        ));

        return "Welcome to Kayise IT. How can we help you today? $options";
    }

    /**
     * Play a message and get menu input
     */
    public function getMenuResponse(string $message = null, int $attemptNumber = 1): VoiceResponse
    {
        $message = $message ?: $this->getWelcomeMessage();
        
        $helpText = $attemptNumber > 1 
            ? "Sorry, I didn't understand. Please try again."
            : null;

        return $this->createIvrResponse($message, [
            'action' => route('twilio.ivr.process'),
            'helpText' => $helpText,
            'timeout' => 5,
        ]);
    }

    /**
     * Transfer call to an agent
     */
    public function transferToAgent(): VoiceResponse
    {
        $response = new VoiceResponse();
        
        $response->say(
            "Transferring you to an available agent. Please hold.",
            [
                'voice' => $this->config['kayise_voice'],
                'language' => $this->config['kayise_language']
            ]
        );

        // Dial the agent phone number
        $response->dial(
            $this->config['kayise_phone'],
            [
                'record' => $this->config['record_calls'] ? 'record-all' : 'do-not-record',
                'recordingStatusCallback' => route('twilio.status.callback'),
                'timeout' => 30,
            ]
        );

        // If agent doesn't answer, hang up
        $response->say(
            "No agents are available. Your call has not been answered. Thank you for calling Kayise IT.",
            [
                'voice' => $this->config['kayise_voice'],
                'language' => $this->config['kayise_language']
            ]
        );

        return $response;
    }

    /**
     * Make an outbound call
     */
    public function makeCall(string $toNumber, string $twimlUrl): object
    {
        return $this->client->calls->create(
            $toNumber,
            $this->config['phone_number'],
            [
                'url' => $twimlUrl,
                'record' => $this->config['record_calls'],
                'statusCallback' => route('twilio.status.callback'),
            ]
        );
    }

    /**
     * Send SMS as fallback
     */
    public function sendSms(string $toNumber, string $message): object
    {
        return $this->client->messages->create(
            $toNumber,
            [
                'from' => $this->config['phone_number'],
                'body' => $message,
            ]
        );
    }

    /**
     * Get call recording
     */
    public function getRecording(string $callSid): ?string
    {
        $recordings = $this->client->calls($callSid)->recordings->read();
        return count($recordings) > 0 ? $recordings[0]->uri : null;
    }
}
