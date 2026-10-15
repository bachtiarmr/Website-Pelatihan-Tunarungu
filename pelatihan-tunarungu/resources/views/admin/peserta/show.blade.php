
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #263248;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .card {
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0000000a;
        }

        h1 {
            margin-top: 0;
        }

        .info {
            padding: 15px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .label {
            display: block;
            margin-bottom: 6px;
            color: #68758a;
            font-size: 14px;
        }

        .value {
            font-size: 16px;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            margin-top: 22px;
            padding: 11px 16px;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Detail Peserta</h1>
            <p>Informasi akun peserta pelatihan.</p>

            <div class="info">
                <span class="label">ID Peserta</span>
                <span class="value">{{ $peserta->id }}</span>
            </div>

            <div class="info">
                <span class="label">Nama Lengkap</span>
                <span class="value">{{ $peserta->name }}</span>
            </div>

            <div class="info">
                <span class="label">Email</span>
                <span class="value">{{ $peserta->email }}</span>
            </div>

            <div class="info">
                <span class="label">Tanggal Terdaftar</span>
                <span class="value">
                    {{ $peserta->created_at?->format('d-m-Y H:i') ?? '-' }}
                </span>
            </div>

            <a href="{{ route('admin.peserta.index') }}" class="button">
                Kembali ke Daftar Peserta
            </a>
        </div>
    </div>
</body>
</html>
