
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
</head>
<body>

    <main class="register-container">

        <!-- BAGIAN KIRI -->
        <section class="welcome-section">

            <div class="illustration">
                <img
                    src="{{ asset('image/tunarungu.png') }}"
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
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >

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
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >

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

</body>
</html>
