@php
    $brand      = 'Unicorn Group';
    $brandColor = '#4f46e5'; // আপনার ব্র্যান্ডের রঙ
    $logoPath   = public_path('backend/img/logo/unicorn_logo.png');
    $logoSrc    = (isset($message) && file_exists($logoPath))
        ? $message->embed($logoPath)
        : asset('backend/img/logo/unicorn_logo.png');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light only">
    <title>Reset your password</title>
</head>
<body style="margin:0;padding:0;background:#f1f4f9;font-family:'Segoe UI',Helvetica,Arial,sans-serif;">

    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        Reset your {{ $brand }} account password. This link expires in {{ $expire }} minutes.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f4f9;padding:32px 12px;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                       style="width:100%;max-width:600px;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 4px 18px rgba(20,30,60,.08);">

                    <tr><td style="height:6px;background:{{ $brandColor }};font-size:0;line-height:0;">&nbsp;</td></tr>

                    <tr>
                        <td align="center" style="padding:30px 24px 10px;">
                            <img src="{{ $logoSrc }}" alt="{{ $brand }}" height="56"
                                 style="display:block;height:56px;width:auto;border:0;">
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:14px 36px 4px;">
                            <h1 style="margin:0;font-size:24px;line-height:32px;color:#1f2937;font-weight:700;">
                                Reset your password
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:10px 40px 24px;">
                            <p style="margin:0;font-size:15px;line-height:24px;color:#6b7280;">
                                Hello {{ $user->name }}, we received a request to reset the password of your account.
                                Click the button below to choose a new password.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:0 36px 8px;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" bgcolor="{{ $brandColor }}" style="border-radius:10px;">
                                        <a href="{{ $url }}" target="_blank"
                                           style="display:inline-block;padding:15px 44px;font-size:16px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:10px;background:{{ $brandColor }};">
                                            Reset Password &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:14px 36px 24px;">
                            <p style="margin:0;font-size:13px;color:#6b7280;line-height:20px;">
                                This link will expire in <strong>{{ $expire }} minutes</strong>.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 36px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                   style="background:#fffbeb;border-left:4px solid #f59e0b;border-radius:6px;">
                                <tr>
                                    <td style="padding:14px 18px;font-size:13px;line-height:21px;color:#92400e;">
                                        <strong>Didn't request this?</strong> You can safely ignore this email.
                                        Your password will not change unless you click the button above.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 36px 26px;">
                            <p style="margin:0;font-size:12px;color:#9ca3af;line-height:18px;">
                                Button not working? Copy this link into your browser:<br>
                                <a href="{{ $url }}" style="color:{{ $brandColor }};word-break:break-all;">{{ $url }}</a>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background:#f8fafc;border-top:1px solid #eef0f3;padding:22px 30px;">
                            <p style="margin:0;font-size:12px;color:#9ca3af;">
                                &copy; {{ date('Y') }} {{ $brand }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>