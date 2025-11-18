<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #475569 0%, #3b82f6 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .info-row {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #475569;
            margin-bottom: 5px;
        }
        .value {
            color: #1f2937;
        }
        .message-box {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Pesan Kontak Baru</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Website SMK Negeri 4 Bogor</p>
        </div>
        
        <div class="content">
            <p style="margin-top: 0;">Anda menerima pesan baru dari formulir kontak website:</p>
            
            <div class="info-row">
                <div class="label">Nama Pengirim:</div>
                <div class="value">{{ $contactData['name'] }}</div>
            </div>
            
            <div class="info-row">
                <div class="label">Email:</div>
                <div class="value">
                    <a href="mailto:{{ $contactData['email'] }}" style="color: #3b82f6; text-decoration: none;">
                        {{ $contactData['email'] }}
                    </a>
                </div>
            </div>
            
            <div class="info-row">
                <div class="label">Subjek:</div>
                <div class="value">{{ $contactData['subject'] }}</div>
            </div>
            
            <div class="info-row">
                <div class="label">Pesan:</div>
                <div class="message-box">
                    {{ $contactData['message'] }}
                </div>
            </div>
            
            <p style="margin-bottom: 0; color: #6b7280; font-size: 14px;">
                <strong>Waktu Diterima:</strong> {{ now()->format('d F Y, H:i') }} WIB
            </p>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">Email ini dikirim otomatis dari sistem website.</p>
            <p style="margin: 5px 0 0 0;">© {{ date('Y') }} SMK Negeri 4 Bogor</p>
        </div>
    </div>
</body>
</html>
