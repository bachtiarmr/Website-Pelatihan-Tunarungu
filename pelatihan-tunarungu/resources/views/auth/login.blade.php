
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Web Pelatihan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background: #f0f6ff;
            font-family: 'Instrument Sans', sans-serif;
            color: #174b78;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            padding: 40px;
            background: white;
            border: 1px solid #c8e0ff;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(23, 75, 120, 0.08);
        }

        h1 {
            margin: 0 0 10px;
            font-size: 30px;
        }

        .subtitle {
            margin: 0 0 30px;
            color: #7186a0;
            line-height: 1.6;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #cbdcf1;
            border-radius: 8px;
            font: inherit;
        }

        input:focus {
            outline: 2px solid #93c5fd;
            border-color: #3781e5;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .remember input {
            width: auto;
            margin: 0;
            padding: 0;
        }

        button {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 8px;
            background: #347fe1;
            color: white;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            color: #7186a0;
            line-height: 1.8;
        }

        a {
            color: #2474df;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <main class="login-container">
        <h1>Selamat Datang!</h1>
        <p class="subtitle">
            Login untuk melanjutkan ke akunmu.
        </p>

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div role="alert" style="margin-bottom: 16px; color: #b42318;">
                    {{ $errors->first() }}
                </div>
            @endif

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Masukkan email"
                autocomplete="email"
                value="{{ old('email') }}"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >

            <label for="remember" class="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                Ingat saya
            </label>

            <button type="submit">Login</button>
        </form>

        <div class="footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar di sini</a>
            <br>
            <a href="{{ route('home') }}">← Kembali ke Beranda</a>
        </div>
    </main>
</body>
</html>
