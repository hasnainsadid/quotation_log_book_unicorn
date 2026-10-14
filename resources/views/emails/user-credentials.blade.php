@php
    $brand      = 'Unicorn Group';
    $brandColor = '#4f46e5';
    $loginUrl   = url('/login');
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
    <title>Your account details</title>
</head>
<body style="margin:0;padding:0;background:#f1f4f9;font-family:'Segoe UI',Helvetica,Arial,sans-serif;">

    {{-- Inbox preview text --}}
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        Your {{ $brand }} account is ready. Here are your login details.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f4f9;padding:32px 12px;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                       style="width:100%;max-width:600px;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 4px 18px rgba(20,30,60,.08);">

                    {{-- Top accent bar --}}
                    <tr><td style="height:6px;background:{{ $brandColor }};font-size:0;line-height:0;">&nbsp;</td></tr>

                    {{-- Logo --}}
                    <tr>
                        <td align="center" style="padding:30px 24px 10px;">
                            <img src="{{ $logoSrc }}" alt="{{ $brand }}" height="56"
                                 style="display:block;height:56px;width:auto;border:0;">
                        </td>
                    </tr>

                    {{-- Heading --}}
                    <tr>
                        <td align="center" style="padding:14px 36px 4px;">
                            <h1 style="margin:0;font-size:24px;line-height:32px;color:#1f2937;font-weight:700;">
                                Welcome, {{ $user->name }}!
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:6px 40px 24px;">
                            <p style="margin:0;font-size:15px;line-height:24px;color:#6b7280;">
                                Your account has been created{{ $user->designation ? ' as ' . $user->designation : '' }}.
                                Use the details below to sign in.
                            </p>
                        </td>
                    </tr>

                    {{-- Credentials card --}}
                    <tr>
                        <td style="padding:0 36px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                   style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;">
                                <tr>
                                    <td style="padding:18px 22px 6px;">
                                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9ca3af;font-weight:700;">Email</div>
                                        <div style="font-size:16px;color:#111827;padding-top:4px;word-break:break-all;">{{ $user->email }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 22px;"><div style="height:1px;background:#e5e7eb;margin:12px 0;"></div></td>
                                </tr>
                                <tr>
                                    <td style="padding:0 22px 20px;">
                                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9ca3af;font-weight:700;">Temporary Password</div>
                                        <div style="margin-top:8px;display:inline-block;background:#ffffff;border:1px dashed {{ $brandColor }};border-radius:8px;padding:10px 16px;
                                                    font-family:'Courier New',Courier,monospace;font-size:20px;font-weight:700;letter-spacing:2px;color:{{ $brandColor }};">
                                            {{ $password }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Login button --}}
                    <tr>
                        <td align="center" style="padding:30px 36px 8px;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" bgcolor="{{ $brandColor }}" style="border-radius:10px;">
                                        <a href="{{ $loginUrl }}" target="_blank"
                                           style="display:inline-block;padding:15px 44px;font-size:16px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:10px;background:{{ $brandColor }};">
                                            Login to Your Account &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:6px 36px 24px;">
                            <p style="margin:0;font-size:12px;color:#9ca3af;line-height:18px;">
                                Button not working? Copy this link into your browser:<br>
                                <a href="{{ $loginUrl }}" style="color:{{ $brandColor }};word-break:break-all;">{{ $loginUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    {{-- Security note --}}
                    <tr>
                        <td style="padding:0 36px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                   style="background:#fffbeb;border-left:4px solid #f59e0b;border-radius:6px;">
                                <tr>
                                    <td style="padding:14px 18px;font-size:13px;line-height:21px;color:#92400e;">
                                        <strong>Security tip:</strong> Please change this password right after your first login
                                        and never share it with anyone.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td align="center" style="background:#f8fafc;border-top:1px solid #eef0f3;padding:22px 30px;">
                            <p style="margin:0;font-size:13px;color:#6b7280;line-height:20px;">
                                Need help? Contact your administrator.
                            </p>
                            <p style="margin:8px 0 0;font-size:12px;color:#9ca3af;">
                                &copy; {{ date('Y') }} {{ $brand }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>

                <p style="margin:16px 0 0;font-size:11px;color:#9ca3af;">
                    You received this email because an account was created for you.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>