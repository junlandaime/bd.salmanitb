<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran SPN Berhasil</title>
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

                            <p style="margin:0 0 20px;color:#374151;font-size:15px;line-height:1.6;">
                                Alhamdulillah, pendaftaran Anda pada <strong>Sekolah Pranikah Salman ITB</strong> telah berhasil diterima. Berikut ringkasan pendaftaran Anda:
                            </p>

                            {{-- Registration Code --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="background-color:#ecfdf5;border:1px solid #a7f3d0;border-radius:8px;padding:20px;text-align:center;">
                                        <p style="margin:0 0 4px;color:#6b7280;font-size:12px;text-transform:uppercase;letter-spacing:1px;">Kode Registrasi</p>
                                        <p style="margin:0;color:#059669;font-size:28px;font-weight:800;letter-spacing:2px;">{{ $registration->registration_code }}</p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Summary Table --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                                <tr style="background-color:#f9fafb;">
                                    <td style="padding:10px 16px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;">Paket</td>
                                    <td style="padding:10px 16px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:right;">{{ ucfirst(str_replace('_', ' ', $registration->paket)) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 16px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;">Total Infak</td>
                                    <td style="padding:10px 16px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:right;">Rp{{ number_format($registration->total_bayar, 0, ',', '.') }}</td>
                                </tr>
                                <tr style="background-color:#f9fafb;">
                                    <td style="padding:10px 16px;color:#6b7280;font-size:13px;">Metode Bayar</td>
                                    <td style="padding:10px 16px;color:#111827;font-size:13px;font-weight:600;text-align:right;">{{ strtoupper($registration->metode_bayar) }}</td>
                                </tr>
                            </table>

                            @if($registration->status === 'pending')
                            {{-- Payment Instructions --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="background-color:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:20px;">
                                        <p style="margin:0 0 8px;color:#92400e;font-size:14px;font-weight:700;">Instruksi Pembayaran</p>
                                        <p style="margin:0 0 4px;color:#78350f;font-size:13px;">Bank Muamalat</p>
                                        <p style="margin:0 0 4px;color:#78350f;font-size:18px;font-weight:700;">1130011057</p>
                                        <p style="margin:0;color:#78350f;font-size:13px;">a.n. YPM Salman ITB</p>
                                    </td>
                                </tr>
                            </table>
                            @endif

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
