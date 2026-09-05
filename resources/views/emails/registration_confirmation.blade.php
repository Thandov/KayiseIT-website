<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Confirmed – KAYISE IT</title>
</head>
<body style="margin:0;padding:0;background-color:#f0f4ff;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

    <!-- Wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4ff;padding:40px 16px;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(26,38,87,0.10);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#263a57;padding:36px 40px 28px 40px;text-align:center;">
                            <img src="https://www.kayiseit.com/images/logo-white.png" alt="KAYISE IT" width="180" style="display:block;margin:0 auto 20px auto;max-width:180px;height:auto;border:0;outline:none;">
                            <!-- Checkmark circle -->
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 16px auto;">
                                <tr>
                                    <td style="background-color:#22C55E;border-radius:50%;width:60px;height:60px;text-align:center;vertical-align:middle;">
                                        <span style="font-size:32px;line-height:60px;color:#ffffff;">✓</span>
                                    </td>
                                </tr>
                            </table>
                            <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:700;letter-spacing:-0.3px;">Registration Confirmed!</h1>
                            <p style="margin:8px 0 0 0;color:#a8bbd1;font-size:14px;">We've received your interest — we'll be in touch soon.</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:36px 40px;">

                            <p style="margin:0 0 20px 0;color:#263a57;font-size:16px;line-height:1.6;">
                                Dear <strong>{{ $person->name }}</strong>,
                            </p>
                            <p style="margin:0 0 24px 0;color:#4a5568;font-size:15px;line-height:1.7;">
                                Thank you for registering your interest in the <strong style="color:#183ea4;">{{ $person->program->name ?? 'KAYISE IT' }}</strong> programme.
                                We're excited to have you on board and will keep you updated as the programme develops.
                            </p>

                            <!-- Details box -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4ff;border-radius:8px;margin-bottom:28px;overflow:hidden;">
                                <tr>
                                    <td style="padding:20px 24px;">
                                        <p style="margin:0 0 14px 0;color:#183ea4;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;">Your Registration Details</p>
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:6px 0;color:#718096;font-size:13px;width:40%;">Full Name</td>
                                                <td style="padding:6px 0;color:#263a57;font-size:13px;font-weight:600;">{{ $person->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#718096;font-size:13px;border-top:1px solid #dce7ff;">ID Number</td>
                                                <td style="padding:6px 0;color:#263a57;font-size:13px;font-weight:600;border-top:1px solid #dce7ff;">{{ $person->id_number }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#718096;font-size:13px;border-top:1px solid #dce7ff;">Programme</td>
                                                <td style="padding:6px 0;color:#263a57;font-size:13px;font-weight:600;border-top:1px solid #dce7ff;">{{ $person->program->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#718096;font-size:13px;border-top:1px solid #dce7ff;">Location</td>
                                                <td style="padding:6px 0;color:#263a57;font-size:13px;font-weight:600;border-top:1px solid #dce7ff;">{{ $person->location_name }} ({{ $person->location_type_label }}), {{ $person->province }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 16px 0;color:#4a5568;font-size:15px;line-height:1.7;">
                                Our team will reach out to you via email at <strong>{{ $person->email }}</strong> or on <strong>{{ $person->cellphone }}</strong>
                                with more details about next steps and intake dates.
                            </p>
                            <p style="margin:0 0 28px 0;color:#4a5568;font-size:15px;line-height:1.7;">
                                In the meantime, feel free to explore our website to learn more about what KAYISE IT has to offer.
                            </p>

                            <!-- CTA Button -->
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 8px auto;">
                                <tr>
                                    <td style="background-color:#183ea4;border-radius:8px;text-align:center;">
                                        <a href="https://kayiseit.co.za" style="display:inline-block;padding:14px 36px;color:#ffffff;font-size:15px;font-weight:700;text-decoration:none;letter-spacing:0.2px;">Visit Our Website</a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f8fafc;padding:24px 40px;border-top:1px solid #e2e8f0;text-align:center;">
                            <p style="margin:0 0 6px 0;color:#263a57;font-size:14px;font-weight:700;">KAYISE IT (PTY) LTD</p>
                            <p style="margin:0 0 14px 0;color:#718096;font-size:12px;">
                                <a href="mailto:info@kayiseit.co.za" style="color:#183ea4;text-decoration:none;">info@kayiseit.co.za</a>
                                &nbsp;·&nbsp;
                                <a href="https://kayiseit.co.za" style="color:#183ea4;text-decoration:none;">kayiseit.co.za</a>
                            </p>
                            <p style="margin:0;color:#a0aec0;font-size:11px;line-height:1.5;">
                                This is an automated message. Please do not reply directly to this email.<br>
                                You are receiving this because you registered on our website.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End Card -->

            </td>
        </tr>
    </table>

</body>
</html>
