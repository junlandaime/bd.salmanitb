<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran SPN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            line-height: 1.5;
            color: #374151;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #10b981; /* emerald-500 */
            color: #ffffff;
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 24px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }
        .summary-table th, .summary-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .summary-table th {
            font-weight: 600;
            color: #4b5563;
            width: 40%;
        }
        .btn-container {
            text-align: center;
            margin: 32px 0;
        }
        .btn {
            display: inline-block;
            background-color: #059669; /* emerald-600 */
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
        }
        .footer {
            padding: 24px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Konfirmasi Pendaftaran Sekolah Pranikah</h1>
        </div>
        
        <div class="content">
            <div class="greeting">
                Assalamu'alaikum, {{ $registration->nama_lengkap }}
            </div>
            
            <p>Pendaftaran Anda untuk SPN Batch {{ $registration->activityBatch->batch_ke ?? 'XX' }} telah kami terima. Berikut ringkasan data Anda:</p>
            
            <table class="summary-table">
                <tr>
                    <th>Kode Pendaftaran</th>
                    <td>{{ $registration->registration_code }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $registration->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $registration->email }}</td>
                </tr>
                <tr>
                    <th>WhatsApp</th>
                    <td>{{ $registration->whatsapp }}</td>
                </tr>
                <tr>
                    <th>Paket yang dipilih</th>
                    <td>{{ $registration->paket }}</td>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <td>Rp {{ number_format($registration->total_bayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><strong>Menunggu Verifikasi</strong></td>
                </tr>
            </table>

            @if(!empty($hasExistingAccount))
                <div class="btn-container">
                    <a href="{{ route('login') }}" class="btn">Masuk ke Dashboard Peserta</a>
                </div>
            @else
                <div class="btn-container">
                    <a href="{{ route('activation.form', ['token' => $activationToken]) }}" class="btn">Buat Password &amp; Akses Dashboard</a>
                </div>
            @endif
        </div>

        <div class="footer">
            @if(!empty($hasExistingAccount))
                <p>Karena Anda telah memiliki akun di sistem Bidang Dakwah Salman ITB, silakan masuk menggunakan email dan password Anda untuk memantau status pendaftaran di dashboard peserta.</p>
            @else
                <p>Silakan buat password untuk mengakses dashboard peserta. Di dashboard, Anda bisa memantau status pendaftaran dan mengedit data jika diperlukan.</p>
            @endif
        </div>
    </div>
</body>
</html>
