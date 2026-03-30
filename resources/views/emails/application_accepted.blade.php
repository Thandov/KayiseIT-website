@component('mail::message')
# Application Accepted

Dear {{ $application->name }},

Great news! Your application for the **{{ $application->app_type }}** program in **{{ $application->field }}** has been **accepted**.

## Application Details
- **Application ID:** {{ $application->app_id }}
- **Program:** {{ $application->app_type }}
- **Field:** {{ $application->field }}
- **Program Partner:** {{ $application->program_partner ?? 'N/A' }}
- **Status:** Accepted

## Message from KAYISE IT
{{ $message }}

Next steps will be communicated to you via email. If you have any questions, please don't hesitate to contact us.

@component('mail::button', ['url' => route('profile')])
View Your Application
@endcomponent

Best regards,  
**KAYISE IT**

---
This is an automated message. Please do not reply directly to this email.
@endcomponent
