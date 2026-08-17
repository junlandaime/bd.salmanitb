<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Ditolak</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f4f4f4;padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#10b981;padding:28px 32px;text-align:center;">
                            <h1 style="margin:0;color:#ffffff;font-size:22px;font-weight:700;">SPN Salman ITB</h1>
                            <p style="margin:6px 0 0;color:#d1fae5;font-size:13px;">Sekolah Pranikah Salman ITB</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 16px;color:#374151;font-size:15px;line-height:1.6;">
                                Assalamualaikum Warahmatullahi Wabarakatuh,<br><strong>{{ $registration->nama_lengkap }}</strong>
                            </p>

                            {{-- Status Badge --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="background-color:#fef2f2;border:2px solid #fca5a5;border-radius:8px;padding:20px;text-align:center;">
                                        <p style="margin:0 0 4px;color:#6b7280;font-size:12px;">Status Pembayaran</p>
                                        <p style="margin:0;color:#dc2626;font-size:22px;font-weight:800;">❌ DITOLAK</p>
                                        <p style="margin:8px 0 0;color:#6b7280;font-size:12px;">Kode: {{ $registration->registration_code }}</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 20px;color:#374151;font-size:15px;line-height:1.6;">
                                Mohon maaf, pembayaran Anda untuk pendaftaran Sekolah Pranikah Salman ITB belum dapat diverifikasi dengan alasan berikut:
                            </p>

                            {{-- Reason --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="background-color:#fef2f2;border-left:4px solid #ef4444;border-radius:4px;padding:16px 20px;">
                                        <p style="margin:0 0 4px;color:#991b1b;font-size:12px;font-weight:700;text-transform:uppercase;">Alasan Penolakan</p>
                                        <p style="margin:0;color:#7f1d1d;font-size:14px;line-height:1.6;">{{ $registration->catatan_admin ?? 'Tidak ada keterangan.' }}</p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Instructions --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="background-color:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:20px;">
                                        <p style="margin:0 0 8px;color:#92400e;font-size:14px;font-weight:700;">Yang Dapat Anda Lakukan</p>
                                        <ul style="margin:0;padding:0 0 0 20px;color:#78350f;font-size:13px;line-height:1.8;">
                                            <li>Periksa kembali bukti pembayaran Anda</li>
                                            <li>Pastikan transfer sesuai nominal yang tertera</li>
                                            <li>Hubungi panitia melalui WhatsApp untuk klarifikasi</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>

                            {{-- WhatsApp CTA --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding:8px 0 0;">
                                        <a href="https://wa.me/6282126714989" target="_blank" style="display:inline-block;background-color:#10b981;color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:8px;font-size:14px;font-weight:600;">Hubungi Panitia via WhatsApp</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#f9fafb;padding:20px 32px;text-align:center;border-top:1px solid #e5e7eb;">
                            <p style="margin:0;color:#9ca3af;font-size:12px;">&copy; {{ date('Y') }} SPN Salman ITB &mdash; Bidang Dakwah Masjid Salman ITB</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
