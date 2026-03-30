# Twilio AI Phone Agent Setup Guide

This guide walks you through setting up the phone-based AI agent for Kayise IT using Twilio.

## Overview

The system provides:
- **Incoming Call Handling**: Automatically answers calls with a welcome message
- **Interactive Voice Response (IVR)**: Menu-driven phone interface matching your website
- **AI Agent**: Responds to user selections with relevant information
- **Human Transfer**: Routes calls to your team when needed
- **Call Logging**: Records all call details for reference

## Prerequisites

1. **Twilio Account**: Sign up at https://www.twilio.com
2. **Twilio Phone Number**: Purchase a phone number in Twilio console
3. **Composer Twilio Package**: Install via Composer (if not already done)
4. **Laravel App**: Your Kayise IT Laravel application (already configured)

## Step 1: Install Twilio SDK

Run in your project directory:

```bash
composer require twilio/sdk
```

## Step 2: Get Twilio Credentials

1. Log in to Twilio Console: https://www.twilio.com/console
2. Find your:
   - **Account SID** (copy from dashboard)
   - **Auth Token** (copy from dashboard)
   - **Phone Number** (the one you purchased, e.g., +1234567890)

## Step 3: Update Environment Variables

Add these to your `.env` file:

```bash
# Twilio Credentials
TWILIO_ACCOUNT_SID=your_account_sid_here
TWILIO_AUTH_TOKEN=your_auth_token_here
TWILIO_PHONE_NUMBER=+1234567890  # Your Twilio phone number

# Kayise IT Phone Configuration
KAYISE_PHONE_NUMBER=+27877022625  # Where to transfer calls
TWILIO_VOICE=alice  # Options: alice, man, woman
TWILIO_LANGUAGE=en-GB
TWILIO_RECORD_CALLS=false  # Set to true to record calls
TWILIO_SMS_FALLBACK=false  # Set to true for SMS fallback

# Webhook Configuration
APP_URL=https://yourdomain.com  # Your live domain (required for Twilio webhooks)
```

## Step 4: Configure Twilio Webhook

1. Go to Twilio Console → Phone Numbers → Manage Numbers
2. Click on your phone number
3. Scroll to "Voice Configuration"
4. Set **A Call Comes In** webhook to:
   ```
   https://yourdomain.com/api/twilio/ivr/incoming
   ```
   Method: `HTTP POST`

5. Set **Status Callback** to:
   ```
   https://yourdomain.com/api/twilio/status
   ```
   Method: `HTTP POST`

## Step 5: Test the System

### Option A: Call Your Twilio Number

1. Dial the Twilio phone number you set up
2. You should hear: "Welcome to Kayise IT. How can we help you today?"
3. Press numbers 1-5 to test menu options
4. Press 0 to test agent transfer

### Option B: Make Outbound Calls (Optional)

Use the TwilioService to make test calls:

```bash
php artisan tinker
```

Then:

```php
$twilio = app(App\Services\TwilioService::class);
$call = $twilio->makeCall('+27873579146', 'https://yourdomain.com/api/twilio/ivr/incoming');
dd($call->sid); // Shows call ID
```

## Menu Structure

Users can select:

- **Press 1**: Services (information about what Kayise IT offers)
- **Press 2**: Opportunities (internships and careers)
- **Press 3**: Training Programs (drone, ICT, 4IR, etc.)
- **Press 4**: Certification (about certifications)
- **Press 5**: Contact (contact information)
- **Press 0**: Speak to Agent (transfer to +27877022625)

## Customizing Responses

Edit the `ChatbotResponseService` class at:
```
app/Services/ChatbotResponseService.php
```

Add or modify responses in the $responses array.

## File Structure

```
app/
├── Http/
│   └── Controllers/
│       └── TwilioIvrController.php       # Handles IVR logic
├── Services/
│   ├── TwilioService.php                 # Twilio API wrapper
│   └── ChatbotResponseService.php        # AI responses
│
config/
└── twilio.php                             # Twilio configuration

routes/
└── api.php                                # Twilio webhook routes
```

## Logs and Monitoring

All calls are logged to:
```
storage/logs/laravel.log
```

Monitor logs with:
```bash
tail -f storage/logs/laravel.log | grep "Call Status"
```

## Features Available Now

✅ Incoming call answering
✅ IVR menu system  
✅ AI-powered responses to menu selections
✅ Call transfer to agent
✅ Call status logging
✅ Call recordings (optional)
✅ Handles DTMF input (button presses)

## Future Enhancements

- [ ] Voice recognition (speech-to-text)
- [ ] SMS fallback support 
- [ ] Call queue management
- [ ] Analytics dashboard
- [ ] Custom greeting recordings
- [ ] Voicemail to email

## Troubleshooting

### Calls Not Connecting
- Check your Twilio Account SID and Auth Token are correct
- Verify the phone number is active in Twilio
- Ensure APP_URL is set correctly and points to live domain

### Webhook Not Being Called
- Verify the webhook URL is correct in Twilio console
- Check that your domain is publicly accessible
- Look at Twilio logs in Twilio console

### Agent Transfer Not Working
- Verify KAYISE_PHONE_NUMBER is set correctly
- Test calling the agent number directly to ensure it works
- Check logs for transfer errors

### Getting 404 Errors
- Ensure API routes are registered correctly
- Check that routes are not protected by auth middleware
- Verify route names match in TwilioService

## Security Notes

⚠️ **Important**: 
- Never commit `.env` file with real credentials
- Use environment variables for all secrets
- Twilio webhook routes are excluded from CSRF - this is intentional
- Consider adding IP whitelist to Twilio routes if needed

## Support & Resources

- Twilio Docs: https://www.twilio.com/docs
- Twilio TwiML: https://www.twilio.com/docs/voice/twiml
- Test Twilio webhook locally: Use ngrok (https://ngrok.com)

```bash
# Example: Test locally with ngrok
ngrok http 8000
# Use ngrok URL in Twilio webhook settings
```

## Next Steps

1. Deploy your Laravel app to a live server
2. Implement IP whitelisting for webhook routes (optional but recommended)
3. Test all menu options thoroughly
4. Monitor call logs for issues
5. Customize responses to match your team's style
6. Consider adding voice recognition for better UX
