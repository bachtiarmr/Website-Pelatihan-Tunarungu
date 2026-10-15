
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
        /* RESET */
        * {
            box-sizing: border-box;
        }

        /* BACKGROUND HALAMAN */
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;

            background:
                linear-gradient(
                    rgba(240, 246, 255, 0.70),
                    rgba(240, 246, 255, 0.70)
                ),
                url("{{ asset('image/background.jpg') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            font-family: 'Instrument Sans', sans-serif;
            color: #174b78;
        }

        /* KOTAK LOGIN */
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 36px;

            background: rgba(255, 255, 255, 0.96);
            border: 1px solid #c8e0ff;
            border-radius: 16px;

            box-shadow: 0 15px 45px rgba(23, 75, 120, 0.15);
            backdrop-filter: blur(8px);
        }

        /* JUDUL */
        h1 {
            margin: 0 0 10px;
            font-size: 30px;
            line-height: 1.25;
            color: #174b78;
        }

        .subtitle {
            margin: 0 0 26px;
            color: #7186a0;
            line-height: 1.6;
        }

        /* LABEL */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        /* INPUT EMAIL DAN PASSWORD */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            display: block;
            width: 100%;
            padding: 13px 14px;
            margin-bottom: 18px;

            border: 1px solid #cbdcf1;
            border-radius: 8px;
            background: #ffffff;

            font: inherit;
            color: #174b78;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        .password-wrapper input[type="text"]:focus {
            outline: none;
            border-color: #3781e5;
            box-shadow: 0 0 0 3px rgba(55, 129, 229, 0.12);
        }

        /* PEMBUNGKUS INPUT PASSWORD */
        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        /* TOMBOL IKON MATA */
        .toggle-password {
            position: absolute;
            top: 0;
            right: 0;

            width: 44px;
            height: 44px;
            padding: 0;
            margin: 0;

            display: flex;
            justify-content: center;
            align-items: center;

            background: transparent;
            color: #7186a0;
            border: none;
            border-radius: 8px;

            cursor: pointer;
        }

        .toggle-password:hover {
            background: transparent;
            color: #2474df;
        }

        .toggle-password svg {
            display: block;
            width: 21px;
            height: 21px;
            pointer-events: none;
        }

        .toggle-password:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: -3px;
        }

        /* INGAT SAYA */
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-weight: 400;
            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #347fe1;
            cursor: pointer;
        }

        /* TOMBOL LOGIN */
        .login-button {
            width: 100%;
            padding: 13px;
            border: 0;
            border-radius: 8px;

            background: #347fe1;
            color: #ffffff;

            font: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .login-button:hover {
            background: #2369c6;
        }

        .login-button:active {
            transform: scale(0.99);
        }

        .login-button:focus-visible,
        a:focus-visible {
            outline: 3px solid #83b8ff;
            outline-offset: 3px;
        }

        /* PESAN ERROR */
        .error-message {
            margin-bottom: 16px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #fff0f0;
            color: #b42318;
            font-size: 14px;
        }

        /* LINK BAGIAN BAWAH */
        .footer {
            margin-top: 22px;
            text-align: center;
            color: #7186a0;
            line-height: 1.9;
            font-size: 14px;
        }

        a {
            color: #2474df;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        /* TAMPILAN HP */
        @media (max-width: 480px) {
            body {
                padding: 16px;
                background-attachment: scroll;
            }

            .login-container {
                max-width: 100%;
                padding: 28px 22px;
            }

            h1 {
                font-size: 26px;
            }

            .subtitle {
                font-size: 14px;
                margin-bottom: 22px;
            }
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
                <div role="alert" class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- EMAIL -->
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

            <!-- PASSWORD -->
            <label for="password">Password</label>

            <div class="password-wrapper">
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

                <button
                    type="button"
                    class="toggle-password"
                    id="togglePassword"
                    aria-label="Tampilkan password"
                    aria-pressed="false"
                >
                    <svg
                        id="eyeIcon"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>

            <!-- INGAT SAYA -->
            <label for="remember" class="remember">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    value="1"
                >
                Ingat saya
            </label>

            <!-- TOMBOL LOGIN -->
            <button type="submit" class="login-button">
                Login
            </button>

        </form>

        <!-- LINK BAWAH -->
        <div class="footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar di sini</a>

            <br>

            <a href="{{ route('home') }}">
                ← Kembali ke Beranda
            </a>
        </div>

    </main>

    <!-- JAVASCRIPT IKON MATA -->
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';

            // Tampilkan atau sembunyikan password
            passwordInput.type = isHidden ? 'text' : 'password';

            // Perbarui informasi aksesibilitas
            togglePassword.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );

            togglePassword.setAttribute(
                'aria-pressed',
                String(isHidden)
            );

            // Ganti ikon mata
            if (isHidden) {
                // Ikon mata dicoret
                eyeIcon.innerHTML = `
                    <path d="M3 3l18 18"/>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                    <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15 15 0 0 1-3 3.8"/>
                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.1 0 2.1-.2 3-.5"/>
                `;
            } else {
                // Ikon mata normal
                eyeIcon.innerHTML = `
                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;
            }
        });
    </script>

</body>
</html>
