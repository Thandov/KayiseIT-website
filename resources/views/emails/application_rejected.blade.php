@component('mail::message')
# Application Status Update

Dear {{ $application->name }},

Thank you for your application to the **{{ $application->app_type }}** program in **{{ $application->field }}**.

After careful review, we regret to inform you that your application has not been accepted at this time.

## Application Details
- **Application ID:** {{ $application->app_id }}
- **Program:** {{ $application->app_type }}
- **Field:** {{ $application->field }}
- **Program Partner:** {{ $application->program_partner ?? 'N/A' }}
- **Status:** Not Accepted

## Message from KAYISE IT
{{ $message }}

We encourage you to apply again in the future. For feedback or further information, please visit your profile to view your application status.

@component('mail::button', ['url' => route('profile')])
View Your Application
@endcomponent

Best regards,  
**KAYISE IT**

---
This is an automated message. Please do not reply directly to this email.
@endcomponent
