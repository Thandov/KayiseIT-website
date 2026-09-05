<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Your certificate — KAYISE IT</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
    {{-- Preheader (hidden in many clients) --}}
    <div style="display:none;max-height:0;overflow:hidden;mso-hide:all;">
        Your official certificate PDF is attached. Congratulations on completing {{ $trainingName }} with KAYISE IT.
    </div>

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f1f5f9;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:600px;background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(15,23,42,0.08);">

                    {{-- Brand bar --}}
                    <tr>
                        <td style="height:4px;background-color:#16A34A;"></td>
                    </tr>

                    {{-- Header --}}
                    <tr>
                        <td style="padding:28px 32px 8px 32px;text-align:center;">
                            <a href="{{ $appUrl }}" style="text-decoration:none;display:inline-block;" target="_blank" rel="noopener">
                                <img src="{{ $appUrl }}/images/kayise_IT_logo_No_Background.png" alt="KAYISE IT" width="180" height="auto" style="display:block;margin:0 auto;max-width:180px;height:auto;border:0;outline:none;">
                            </a>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:8px 32px 32px 32px;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.65;color:#334155;">
                            <p style="margin:0 0 16px 0;font-size:20px;font-weight:700;color:#0f172a;letter-spacing:-0.02em;">
                                Congratulations, {{ $recipientName }}
                            </p>
                            <p style="margin:0 0 16px 0;">
                                You have successfully completed <strong style="color:#0f172a;">{{ $trainingName }}</strong>. Your official certificate is attached to this email as a PDF (<strong>{{ $attachmentFilename }}</strong>).
                            </p>
                            <p style="margin:0 0 24px 0;">
                                Keep this document for your records. If the attachment does not open, reply to this email or contact us and we will assist you.
                            </p>

                            {{-- Highlight box --}}
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;">
                                <tr>
                                    <td style="padding:16px 18px;font-size:14px;color:#065f46;">
                                        <strong style="display:block;margin-bottom:6px;color:#047857;">What’s next?</strong>
                                        Share your achievement on LinkedIn, add the certificate to your CV, and stay connected with KAYISE IT for future programmes.
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:28px 0 0 0;font-size:15px;color:#64748b;">
                                Questions? Email <a href="mailto:info@kayiseit.com" style="color:#059669;font-weight:600;text-decoration:none;">info@kayiseit.com</a>
                                &nbsp;·&nbsp;
                                <a href="{{ $appUrl }}" style="color:#059669;font-weight:600;text-decoration:none;">kayiseit.com</a>
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:20px 32px;background-color:#0f172a;text-align:center;">
                            <p style="margin:0;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:12px;line-height:1.6;color:#94a3b8;">
                                © {{ date('Y') }} KAYISE IT · ICT training &amp; digital solutions
                            </p>
                            <p style="margin:8px 0 0 0;font-size:11px;color:#64748b;">
                                This message was sent because you requested your certificate on our website with this email address.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
