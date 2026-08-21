<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru dari Form Kontak</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background-color: #f4f4f5; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e293b, #334155); padding: 32px 40px; text-align: center;">
                            <h1 style="color: #ffffff; font-size: 22px; font-weight: 800; margin: 0; letter-spacing: -0.5px;">Pesan Baru dari Website</h1>
                            <p style="color: #94a3b8; font-size: 14px; margin: 8px 0 0 0;">SMA GIKI 3 Surabaya</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-bottom: 16px;">
                                        <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin: 0 0 4px 0;">Nama Pengirim</p>
                                        <p style="font-size: 16px; font-weight: 600; color: #1e293b; margin: 0;">{{ $contactMessage->name }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 16px;">
                                        <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin: 0 0 4px 0;">Email Pengirim</p>
                                        <p style="font-size: 16px; color: #2563eb; margin: 0;">
                                            <a href="mailto:{{ $contactMessage->email }}" style="color: #2563eb; text-decoration: none;">{{ $contactMessage->email }}</a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 16px;">
                                        <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin: 0 0 4px 0;">Subjek</p>
                                        <p style="font-size: 16px; font-weight: 600; color: #1e293b; margin: 0;">{{ $contactMessage->subject }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 8px;">
                                        <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin: 0 0 4px 0;">Pesan</p>
                                        <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-top: 4px;">
                                            <p style="font-size: 15px; color: #334155; margin: 0; line-height: 1.7; white-space: pre-wrap;">{{ $contactMessage->message }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8fafc; padding: 24px 40px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="font-size: 13px; color: #64748b; margin: 0;">
                                Dikirim pada {{ $contactMessage->created_at->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') }} WIB
                            </p>
                            <p style="font-size: 13px; color: #64748b; margin: 8px 0 0 0;">
                                <a href="{{ url('/admin/contact-messages/' . $contactMessage->id) }}" style="color: #2563eb; text-decoration: underline;">Lihat di Panel Admin &rarr;</a>
                            </p>
                        </td>
                    </tr>
                </table>
                <p style="font-size: 12px; color: #94a3b8; margin-top: 24px;">&copy; {{ date('Y') }} SMA GIKI 3 Surabaya. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
