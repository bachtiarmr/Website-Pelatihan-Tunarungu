
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrasi Peserta | Web Pelatihan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <style>
        /* Memastikan seluruh ikon di dalam input berada pada posisi yang benar */
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        .input-wrapper > svg:first-child {
            position: absolute;
            left: 14px;
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            pointer-events: none;
            color: #6685a5;
            z-index: 1;
        }

        .input-wrapper input {
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }

        /* Ruang untuk ikon gembok di kiri */
        .input-wrapper input[type="text"],
        .input-wrapper input[type="email"],
        .input-wrapper input[type="tel"],
        .input-wrapper input[type="password"] {
            padding-left: 44px;
        }

        /* Tombol mata */
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 6px;
            background: transparent;
            color: #6685a5;
            cursor: pointer;
            z-index: 3;
        }

        .password-toggle:hover {
            color: #327fe0;
            background: #f0f6ff;
        }

        .password-toggle:focus-visible {
            outline: 2px solid #327fe0;
            outline-offset: 2px;
        }

        .password-toggle svg {
            position: static;
            width: 19px;
            height: 19px;
            flex-shrink: 0;
            color: inherit;
            pointer-events: none;
        }

        /* Mencegah tulisan password bertabrakan dengan tombol mata */
        .input-wrapper input.password-input {
            padding-left: 44px;
            padding-right: 48px;
        }

        @media (max-width: 600px) {
            .password-toggle {
                right: 8px;
            }
        }
    </style>
</head>

<body>

    <main class="register-container">

        <!-- BAGIAN KIRI -->
        <section class="welcome-section">

            <div class="illustration">
                <img
                    src="{{ asset('image/deaf.jpg') }}"
                    alt="Ilustrasi peserta menggunakan bahasa isyarat"
                    class="register-illustration"
                >
            </div>

            <h1>
                Belajar Tanpa Batas<br>
                Raih Masa Depan
            </h1>

            <p>
                Platform pelatihan yang dirancang khusus
                untuk penyandang disabilitas tunarungu.
                Belajar dengan materi visual, teks, dan video
                yang mudah dipahami.
            </p>

        </section>

        <!-- BAGIAN KANAN -->
        <section class="form-section">

            <div class="form-header">
                <h2>Daftar Akun</h2>
                <p>Bergabung untuk mulai belajar</p>
            </div>

            <!-- FORM REGISTRASI -->
            <form
                action="{{ route('register.process') }}"
                method="POST"
                id="registerForm"
            >

                @csrf

                <!-- PESAN ERROR -->
                @if ($errors->any())
                    <div
                        role="alert"
                        style="color: #b91c1c; margin-bottom: 16px;"
                    >
                        <ul style="padding-left: 20px; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- NAMA LENGKAP -->
                <div class="form-group">

                    <label for="name">Nama Lengkap</label>

                    <div class="input-wrapper">

                        <svg
                            aria-hidden="true"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="12" cy="8" r="3.5"/>
                            <path d="M5 20a7 7 0 0 1 14 0"/>
                        </svg>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Nama Lengkap"
                            autocomplete="name"
                            value="{{ old('name') }}"
                            maxlength="255"
                            required
                        >

                    </div>
                </div>

                <!-- EMAIL -->
                <div class="form-group">

                    <label for="email">Email</label>

                    <div class="input-wrapper">

                        <svg
                            aria-hidden="true"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="3.5" y="5.5" width="17" height="13" rx="2"/>
                            <path d="m4.5 7 7.5 5.5L19.5 7"/>
                        </svg>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Email"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            required
                        >

                    </div>
                </div>

                <!-- NOMOR HP -->
                <div class="form-group">

                    <label for="nomor_hp">Nomor HP</label>

                    <div class="input-wrapper">

                        <svg
                            aria-hidden="true"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="6.5" y="2.5" width="11" height="19" rx="2"/>
                            <path d="M10 18.5h4"/>
                        </svg>

                        <input
                            type="tel"
                            id="nomor_hp"
                            name="nomor_hp"
                            placeholder="Nomor HP"
                            autocomplete="tel"
                            value="{{ old('nomor_hp') }}"
                            maxlength="20"
                            required
                        >

                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="form-group">

                    <label for="password">Password</label>

                    <div class="input-wrapper">

                        <svg
                            aria-hidden="true"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="5" y="10" width="14" height="11" rx="2"/>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                        </svg>

                        <input
                            class="password-input"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword('password', this)"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                        >
                            <svg
                                class="eye-icon"
                                aria-hidden="true"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>

                    </div>
                </div>

                <!-- KONFIRMASI PASSWORD -->
                <div class="form-group">

                    <label for="password_confirmation">
                        Konfirmasi Password
                    </label>

                    <div class="input-wrapper">

                        <svg
                            aria-hidden="true"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="5" y="10" width="14" height="11" rx="2"/>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                        </svg>

                        <input
                            class="password-input"
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword('password_confirmation', this)"
                            aria-label="Tampilkan konfirmasi password"
                            aria-pressed="false"
                        >
                            <svg
                                class="eye-icon"
                                aria-hidden="true"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>

                    </div>
                </div>

                <!-- TOMBOL DAFTAR -->
                <button type="submit" class="register-button">
                    Daftar
                </button>

                <!-- LINK LOGIN -->
                <p class="login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </form>

        </section>

    </main>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('.eye-icon');

            if (!input || !icon) {
                return;
            }

            const showPassword = input.type === 'password';

            input.type = showPassword ? 'text' : 'password';

            if (showPassword) {
                // Ikon mata dicoret
                icon.innerHTML = `
                    <path d="M3 3l18 18"/>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                    <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15.7 15.7 0 0 1-4 4.7"/>
                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1 0 2-.2 2.9-.5"/>
                `;

                button.setAttribute('aria-pressed', 'true');
                button.setAttribute('aria-label', 'Sembunyikan password');
            } else {
                // Ikon mata normal
                icon.innerHTML = `
                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;

                button.setAttribute('aria-pressed', 'false');
                button.setAttribute(
                    'aria-label',
                    inputId === 'password'
                        ? 'Tampilkan password'
                        : 'Tampilkan konfirmasi password'
                );
            }
        }
    </script>

</body>
</html>
