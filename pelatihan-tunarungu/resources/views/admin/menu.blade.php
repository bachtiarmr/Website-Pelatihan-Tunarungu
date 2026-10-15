
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($menu) }} - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f8fd;
            color: #294866;
            padding: 35px;
        }

        .card {
            background: white;
            border: 1px solid #e1eaf4;
            border-radius: 12px;
            padding: 25px;
            max-width: 650px;
        }

        a {
            display: inline-block;
            margin-top: 18px;
            color: #2878d5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Halaman {{ ucfirst($menu) }}</h1>
        <p>Menu Admin Web Pelatihan Tunarungu.</p>
        <p>Fitur ini akan dikembangkan pada tahap berikutnya.</p>

        <a href="{{ route('admin.dashboard') }}">
            &larr; Kembali ke Dashboard Admin
        </a>
    </div>
</body>
</html>
