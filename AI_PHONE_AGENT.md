# Kayise IT - AI Phone Agent System

## 📞 Overview

This is a production-ready **Interactive Voice Response (IVR) system** powered by **AI** that:

✅ **Automatically answers calls** with a welcoming greeting  
✅ **Presents a menu** for callers to navigate (press 1, 2, 3, etc.)  
✅ **Provides intelligent responses** based on user selection  
✅ **Transfers to a live agent** when the caller needs human assistance  
✅ **Logs all calls** for analytics and monitoring  
✅ **Records conversations** (optional)  

---

## 🎯 System Flow

```
Caller dials Twilio number
         ↓
System answers with welcome message
         ↓
Menu presented: Press 1-5 for services/opportunities/training/certification/contact
         ↓
Caller presses number (DTMF input)
         ↓
AI provides relevant response
         ↓
Offer to: Get more info, return to menu, OR speak to agent (press 0)
         ↓
If agent requested → Transfer to +27 87 702 26 25
```

---

## 📁 Project Structure

### Configuration
- **`config/twilio.php`** - Twilio credentials and IVR menu structure

### Services
- **`app/Services/TwilioService.php`** - Twilio API wrapper for making calls, sending SMS, creating TwiML responses
- **`app/Services/ChatbotResponseService.php`** - AI knowledge base with responses for each menu option

### Controllers
- **`app/Http/Controllers/TwilioIvrController.php`** - Handles all incoming calls and IVR logic
- **`app/Http/Controllers/CallLogController.php`** - Analytics and call monitoring dashboard

### Models
- **`app/Models/CallLog.php`** - Stores call details in database

### Database
- **`database/migrations/2024_03_24_create_call_logs_table.php`** - Call history table

### Routes
- **`routes/api.php`** - Webhook endpoints that Twilio calls

### Documentation
- **`TWILIO_SETUP_GUIDE.md`** - Step-by-step installation guide
- **`AI_PHONE_AGENT.md`** - This file

---

## 🚀 Quick Start

### 1. Install Dependencies
```bash
composer require twilio/sdk
```

### 2. Configure Environment (`.env`)
```bash
TWILIO_ACCOUNT_SID=your_account_sid
TWILIO_AUTH_TOKEN=your_auth_token
TWILIO_PHONE_NUMBER=+1234567890
KAYISE_PHONE_NUMBER=+27877022625
APP_URL=https://yourdomain.com
```

### 3. Set Twilio Webhook
Point your Twilio phone number to:
- **Incoming call:** `https://yourdomain.com/api/twilio/ivr/incoming`

### 4. Run Database Migration (Optional - for call logging)
```bash
php artisan migrate
```

### 5. Test the System
Call your Twilio number and follow the prompts.

---

## 📋 Menu Options

When users call, they hear:
> "Welcome to Kayise IT. How can we help you today?"

Then they can:
- **Press 1** → Services information
- **Press 2** → Opportunities (internships/careers)
- **Press 3** → Training programs
- **Press 4** → Certification details
- **Press 5** → Contact information
- **Press 0** → Speak to a live agent

---

## 🤖 AI Responses

The system includes pre-configured responses for each menu option. These are defined in:

```php
app/Services/ChatbotResponseService.php
```

Each response includes:
- **Intent** - The category (e.g., "services", "opportunities")
- **Questions** - Keywords that match this intent
- **Response** - The voice message to play

### Example Response:

```php
[
    'intent' => 'services',
    'questions' => ['services', 'what services', 'what can you do'],
    'response' => 'KAYISE IT offers drone building training, ICT skills training, cyber security training, and more.'
]
```

### Customizing Responses

Edit `app/Services/ChatbotResponseService.php` to:
- Add new/remove menu options
- Change response text
- Add new intents

---

## 📊 Call Tracking & Analytics

### View Call Logs

Access the admin dashboard at:
```
/admin/call-logs
```

See:
- Total calls made
- Success/failure rates
- Average call duration
- Calls transferred to agents
- Detailed call history

### Export Data

Export call logs to CSV:
```
/admin/call-logs/export?from_date=2024-01-01&to_date=2024-12-31
```

### API Analytics

Get JSON analytics data:
```
GET /admin/call-logs/analytics?days=30
```

Response includes:
```json
{
  "total_calls": 150,
  "average_duration": "245",
  "calls_per_day": [...],
  "calls_by_status": [...]
}
```

---

## 🔧 Advanced Configuration

### Change Voice/Language

In `.env`:
```bash
TWILIO_VOICE=alice        # Options: alice, man, woman
TWILIO_LANGUAGE=en-GB     # Options: en-GB, en-US, etc.
```

### Enable Call Recording

In `.env`:
```bash
TWILIO_RECORD_CALLS=true
```

Recordings stored and linked in call logs.

### SMS Fallback (Optional)

For users without voice support:
```bash
TWILIO_SMS_FALLBACK=true
```

---

## 🔐 Security

✅ **CSRF Protection Disabled** for Twilio webhooks only (required)  
✅ **Environment Variables** store all sensitive data  
✅ **Call Logs** accessible only via authenticated admin routes  
✅ **Status Callbacks** validate Twilio origin (add IP whitelist)  

---

## 🐛 Troubleshooting

### Issue: Calls not connecting
**Solution:**
- Verify Twilio Account SID and Auth Token
- Check phone number is active in Twilio console
- Ensure domain is publicly accessible

### Issue: Webhook not being called
**Solution:**
- Check webhook URL in Twilio console settings
- Verify domain is not behind firewall
- Check Laravel logs for errors

### Issue: Agent transfer fails
**Solution:**
- Test agent number manually
- Check `KAYISE_PHONE_NUMBER` is correct
- Verify agent phone can receive calls

### Issue: Can't hear responses
**Solution:**
- Check Twilio account has credit/balance
- Verify phone number works by calling directly
- Check Laravel logs for errors

---

## 📞 Testing Locally

Use **ngrok** to test locally:

```bash
# In a separate terminal
ngrok http 8000

# Update .env
APP_URL=https://xxxx.ngrok.io

# Update Twilio webhook to ngrok URL
# Then test by calling your Twilio number
```

---

## 📈 Future Enhancements

- [ ] **Speech Recognition** - Let callers speak instead of pressing buttons
- [ ] **Call Queuing** - Queue management when agents are busy
- [ ] **Custom Greetings** - Record your own welcome message
- [ ] **Voicemail** - Capture messages when no agent available
- [ ] **SMS Integration** - Schedule callbacks via SMS
- [ ] **Real-time Dashboard** - Live call monitoring
- [ ] **AI Learning** - Improve responses based on call data

---

## 📚 Related Files

- Twilio Setup Guide: [TWILIO_SETUP_GUIDE.md](./TWILIO_SETUP_GUIDE.md)
- Config: [config/twilio.php](./config/twilio.php)
- Services: [app/Services/](./app/Services/)
- Controllers: [app/Http/Controllers/Twilio*](./app/Http/Controllers/)

---

## 💡 Tips & Best Practices

1. **Test all menu options** before going live
2. **Monitor call logs** regularly for issues
3. **Update responses** to match your team's tone
4. **Set proper agent number** to ensure transfers work
5. **Enable call recording** for quality assurance
6. **Clean old logs** monthly to save storage: `php artisan call-logs:cleanup`

---

## 🤝 Support

For issues with:
- **Twilio**: Visit [twilio.com/help](https://www.twilio.com/help)
- **Laravel**: Check [laravel.com/docs](https://laravel.com/docs)
- **This System**: Review logs in `storage/logs/laravel.log`

---

**Last Updated:** March 24, 2026  
**System Version:** 1.0
