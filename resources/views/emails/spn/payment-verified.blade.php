<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Terverifikasi</title>
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
                                    <td style="background-color:#ecfdf5;border:2px solid #34d399;border-radius:8px;padding:20px;text-align:center;">
                                        <p style="margin:0 0 4px;color:#6b7280;font-size:12px;">Status Pembayaran</p>
                                        <p style="margin:0;color:#059669;font-size:22px;font-weight:800;">✅ TERVERIFIKASI</p>
                                        <p style="margin:8px 0 0;color:#6b7280;font-size:12px;">Kode: {{ $registration->registration_code }}</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 20px;color:#374151;font-size:15px;line-height:1.6;">
                                Alhamdulillah, pembayaran Anda telah berhasil diverifikasi. Anda resmi terdaftar sebagai peserta <strong>Sekolah Pranikah Salman ITB</strong>.
                            </p>

                            {{-- Schedule Info --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                                <tr style="background-color:#f9fafb;">
                                    <td style="padding:10px 16px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;">Jadwal Kegiatan</td>
                                    <td style="padding:10px 16px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:right;">
                                        @if($registration->activityBatch)
                                            {{ $registration->activityBatch->tanggal_mulai_kegiatan->format('d M') }} &ndash; {{ $registration->activityBatch->tanggal_selesai_kegiatan->format('d M Y') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 16px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;">Lokasi</td>
                                    <td style="padding:10px 16px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:right;">Masjid Salman ITB, Bandung</td>
                                </tr>
                                <tr style="background-color:#f9fafb;">
                                    <td style="padding:10px 16px;color:#6b7280;font-size:13px;">Waktu</td>
                                    <td style="padding:10px 16px;color:#111827;font-size:13px;font-weight:600;text-align:right;">Setiap Ahad, 09.30 &ndash; 15.00 WIB</td>
                                </tr>
                            </table>

                            {{-- Account Activation Note --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="background-color:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;padding:20px;">
                                        <p style="margin:0 0 8px;color:#1e40af;font-size:14px;font-weight:700;">Info Akun Alumni</p>
                                        <p style="margin:0;color:#1e3a5f;font-size:13px;line-height:1.6;">Anda akan menerima email aktivasi akun terpisah untuk mengakses portal alumni. Melalui portal alumni, Anda dapat mengakses materi pembelajaran, layanan ta'aruf, dan berbagai fitur eksklusif lainnya.</p>
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
