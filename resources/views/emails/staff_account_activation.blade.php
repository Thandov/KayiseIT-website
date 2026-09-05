<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Activate your staff account – KAYISE IT</title>
</head>
<body style="margin:0;padding:0;background-color:#f0f4ff;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4ff;padding:40px 16px;">
        <tr>
            <td align="center">

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(26,38,87,0.10);">

                    <tr>
                        <td style="background-color:#263a57;padding:36px 40px 28px 40px;text-align:center;">
                            <img src="https://www.kayiseit.com/images/logo-white.png" alt="KAYISE IT" width="180" style="display:block;margin:0 auto 20px auto;max-width:180px;height:auto;border:0;outline:none;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:700;letter-spacing:-0.3px;">Activate your account</h1>
                            <p style="margin:8px 0 0 0;color:#a8bbd1;font-size:14px;">Set your password to start using the KAYISE IT staff dashboard.</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:36px 40px;">

                            <p style="margin:0 0 20px 0;color:#263a57;font-size:16px;line-height:1.6;">
                                Hello {{ $employee->first_name }},
                            </p>
                            <p style="margin:0 0 24px 0;color:#4a5568;font-size:15px;line-height:1.7;">
                                A staff account has been created for you at KAYISE IT. Use the button below to choose your password and activate your login.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4ff;border-radius:8px;margin-bottom:28px;overflow:hidden;">
                                <tr>
                                    <td style="padding:20px 24px;">
                                        <p style="margin:0 0 8px 0;color:#183ea4;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;">Your login</p>
                                        <p style="margin:0;color:#263a57;font-size:14px;"><strong>Work email:</strong> {{ $user->email }}</p>
                                        @if(!empty($deliveryEmail) && strtolower($deliveryEmail) !== strtolower($user->email))
                                            <p style="margin:8px 0 0 0;color:#263a57;font-size:14px;"><strong>This message was sent to:</strong> {{ $deliveryEmail }}</p>
                                        @endif
                                        @if($employee->job_title)
                                            <p style="margin:8px 0 0 0;color:#263a57;font-size:14px;"><strong>Role:</strong> {{ $employee->job_title }}</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 24px auto;">
                                <tr>
                                    <td style="background-color:#183ea4;border-radius:8px;text-align:center;">
                                        <a href="{{ $resetUrl }}" style="display:inline-block;padding:14px 36px;color:#ffffff;font-size:15px;font-weight:700;text-decoration:none;letter-spacing:0.2px;">Activate account</a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0;color:#718096;font-size:13px;line-height:1.6;">
                                If the button does not work, copy and paste this link into your browser:<br>
                                <a href="{{ $resetUrl }}" style="color:#183ea4;word-break:break-all;">{{ $resetUrl }}</a>
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <td style="background-color:#f8fafc;padding:24px 40px;border-top:1px solid #e2e8f0;text-align:center;">
                            <p style="margin:0 0 6px 0;color:#263a57;font-size:14px;font-weight:700;">KAYISE IT (PTY) LTD</p>
                            <p style="margin:0 0 14px 0;color:#718096;font-size:12px;">
                                <a href="mailto:info@kayiseit.co.za" style="color:#183ea4;text-decoration:none;">info@kayiseit.co.za</a>
                                &nbsp;·&nbsp;
                                <a href="https://kayiseit.co.za" style="color:#183ea4;text-decoration:none;">kayiseit.co.za</a>
                            </p>
                            <p style="margin:0;color:#a0aec0;font-size:11px;line-height:1.5;">
                                This is an automated message. Please do not reply directly to this email.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
