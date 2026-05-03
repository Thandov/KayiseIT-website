<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your certificate</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f5;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f4f5;padding:24px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px;background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                <tr>
                    <td style="height:4px;background:#22c55e;line-height:4px;font-size:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding:28px 24px 12px;text-align:center;">
                        <img src="{{ $logoUrl }}" alt="KAYISE IT" width="160" style="display:inline-block;max-width:160px;width:160px;height:auto;border:0;">
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px 28px 28px;color:#111827;font-size:16px;line-height:1.6;">
                        <p style="margin:0 0 16px;font-size:20px;font-weight:700;color:#111827;">Congratulations, {{ $displayName }}</p>
                        <p style="margin:0 0 12px;">You have successfully completed <strong>{{ $trainingName }}</strong>.</p>
                        <p style="margin:0;">Your official certificate is attached to this email as a PDF (<strong>{{ $pdfFilename }}</strong>).</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
