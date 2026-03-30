<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Twilio Credentials
    |--------------------------------------------------------------------------
    |
    | Configuration for Twilio integration for phone-based AI agent
    |
    */

    'account_sid' => env('TWILIO_ACCOUNT_SID'),
    'auth_token' => env('TWILIO_AUTH_TOKEN'),
    'phone_number' => env('TWILIO_PHONE_NUMBER'), // Twilio phone number (e.g., +1234567890)
    
    /*
    |--------------------------------------------------------------------------
    | Kayise IT Phone Configuration
    |--------------------------------------------------------------------------
    |
    | Settings for the Kayise IT phone agent
    |
    */
    
    'kayise_phone' => env('KAYISE_PHONE_NUMBER', '+27877022625'), // Number to transfer to
    'kayise_voice' => env('TWILIO_VOICE', 'alice'), // 'alice', 'man', 'woman'
    'kayise_language' => env('TWILIO_LANGUAGE', 'en-GB'),
    
    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    |
    | URLs that Twilio will call for IVR events
    |
    */
    
    'webhook_url' => env('APP_URL') . '/api/twilio/ivr',
    'status_callback_url' => env('APP_URL') . '/api/twilio/status',
    
    /*
    |--------------------------------------------------------------------------
    | IVR Menu Options
    |--------------------------------------------------------------------------
    |
    | Maps numbers to intents from the chatbot
    |
    */
    
    'menu_options' => [
        '1' => [
            'label' => 'Services',
            'intent' => 'services',
            'description' => 'Get information about our services'
        ],
        '2' => [
            'label' => 'Opportunities',
            'intent' => 'opportunities',
            'description' => 'Learn about internships and job opportunities'
        ],
        '3' => [
            'label' => 'Training Programs',
            'intent' => 'training_programs',
            'description' => 'Information about our training programs'
        ],
        '4' => [
            'label' => 'Certification',
            'intent' => 'certification',
            'description' => 'Details about certifications'
        ],
        '5' => [
            'label' => 'Contact',
            'intent' => 'contact',
            'description' => 'Get our contact information'
        ],
        '0' => [
            'label' => 'Speak to Agent',
            'intent' => 'transfer',
            'description' => 'Transfer to a live representative'
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Call Settings
    |--------------------------------------------------------------------------
    */
    
    'max_ivr_attempts' => 3, // Max times to repeat menu before transfer
    'record_calls' => env('TWILIO_RECORD_CALLS', false),
    'enable_sms_fallback' => env('TWILIO_SMS_FALLBACK', false),
];
