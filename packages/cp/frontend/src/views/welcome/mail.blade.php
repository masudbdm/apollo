<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Contact Message</title>
</head>
<body style="margin:0;padding:0;background:#f5f5f5;">
    <div style="max-width:640px;margin:0 auto;padding:24px;">
        <div style="background:#ffffff;border:1px solid #e5e5e5;border-radius:8px;padding:20px;font-family:Arial, Helvetica, sans-serif;color:#222;">
            <h2 style="margin:0 0 12px;font-size:18px;">
                {{ config('app.name') }} - New Contact Message
            </h2>

            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;font-size:14px;">
                <tr>
                    <td style="padding:6px 0;width:140px;"><strong>Name</strong></td>
                    <td style="padding:6px 0;">{{ $full_name ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;"><strong>Email</strong></td>
                    <td style="padding:6px 0;">{{ $email ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;"><strong>Phone</strong></td>
                    <td style="padding:6px 0;">{{ $contactNumber ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding:6px 0;"><strong>Subject</strong></td>
                    <td style="padding:6px 0;">{{ $subject ?? '' }}</td>
                </tr>
            </table>

            <div style="margin-top:14px;padding-top:14px;border-top:1px solid #eee;">
                <div style="font-size:14px;line-height:1.6;">
                    {!! nl2br(e($details ?? '')) !!}
                </div>
            </div>
        </div>

        <div style="text-align:center;color:#888;font-family:Arial, Helvetica, sans-serif;font-size:12px;margin-top:12px;">
            Sent from {{ config('app.url') }}
        </div>
    </div>
</body>
</html>
