<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun Bidang Dakwah Masjid Salman ITB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            border: 1px solid #e9ecef;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            color: #6c757d;
            font-size: 0.9em;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="/" class="flex justify-center items-center w-full">
                <x-application-logo class="fill-current text-emerald-600" />
            </a>
            <h2>Bidang Dakwah Masjid Salman ITB</h2>
        </div>

        <div class="content">
            <h3>Assalamu'alaikum {{ $user->name }},</h3>

            <p>Terima kasih telah berpartisipasi dalam kegiatan Bidang Dakwah Masjid Salman ITB.</p>

            <p>Anda menerima email ini karena Anda telah terdaftar sebagai alumni kegiatan kami. Untuk mengakses materi
                dan informasi khusus alumni, silakan aktivasi akun Anda dengan mengklik tombol di bawah ini:</p>

            <div style="text-align: center;">
                <a href="{{ url('activation/' . $token) }}" class="button">Aktivasi Akun</a>
            </div>

            <p>Jika tombol di atas tidak berfungsi, silakan salin dan tempel URL berikut ke browser Anda:</p>
            <p>{{ url('activation/' . $token) }}</p>

            <p>Link aktivasi ini akan kedaluwarsa dalam 24 jam.</p>

            <p>Jika Anda tidak merasa mendaftar atau berpartisipasi dalam kegiatan kami, silakan abaikan email ini.</p>

            <p>Wassalamu'alaikum Wr. Wb.</p>

            <p>Hormat kami,<br>
                Tim Bidang Dakwah Masjid Salman ITB</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Bidang Dakwah Masjid Salman ITB. All rights reserved.</p>
            <p>Jl. Ganesa No.10, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132</p>
        </div>
    </div>
</body>

</html>
