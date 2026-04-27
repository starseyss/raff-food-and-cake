<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Bantuan Baru</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .header { background: #F59A40; color: #fff; padding: 24px 32px; }
        .header h1 { margin: 0; font-size: 20px; }
        .body { padding: 32px; }
        .field { margin-bottom: 20px; }
        .field label { display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .field p { margin: 0; font-size: 15px; color: #333; line-height: 1.6; }
        .footer { padding: 20px 32px; background: #fafafa; text-align: center; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📩 Pesan Bantuan Baru</h1>
        </div>
        <div class="body">
            <div class="field">
                <label>Nama Pengirim</label>
                <p>{{ $data['nama'] }}</p>
            </div>
            <div class="field">
                <label>Email</label>
                <p>{{ $data['email'] }}</p>
            </div>
            <div class="field">
                <label>Pesan / Keluhan</label>
                <p>{{ $data['pesan'] }}</p>
            </div>
        </div>
        <div class="footer">
            Dikirim dari formulir kontak RAFF Food & Cake
        </div>
    </div>
</body>
</html>

