<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrasi Peserta | Web Pelatihan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

    <main class="register-container">

        <!-- BAGIAN KIRI -->
        <section class="welcome-section">

            <div class="illustration">
                <svg viewBox="0 0 220 170" role="img"
                     aria-label="Ilustrasi peserta menggunakan bahasa isyarat">
                    <rect width="220" height="170" rx="14" fill="#E5F2FF"/>

                    <!-- Kepala -->
                    <circle cx="105" cy="55" r="23" fill="#F6D2B5"
                            stroke="#174B78" stroke-width="2"/>

                    <!-- Rambut -->
                    <path d="M82 54 Q78 24 105 28 Q130 28 129 52
                             L119 44 L92 46 L86 61 Z"
                          fill="#173D61"/>

                    <!-- Badan -->
                    <path d="M67 145 Q70 95 91 85 L119 85
                             Q144 97 149 145 Z"
                          fill="#2484D8" stroke="#174B78" stroke-width="2"/>

                    <!-- Tangan kiri -->
                    <path d="M77 99 L57 119 L48 111 L64 87
                             Q70 81 79 87"
                          fill="#F6D2B5" stroke="#174B78"
                          stroke-width="3" stroke-linecap="round"/>

                    <!-- Tangan kanan -->
                    <path d="M128 96 L143 77 L139 57
                             M143 77 L153 59 M143 77 L160 66"
                          fill="none" stroke="#F6D2B5"
                          stroke-width="8" stroke-linecap="round"/>

                    <path d="M128 96 L143 77 L139 57
                             M143 77 L153 59 M143 77 L160 66"
                          fill="none" stroke="#174B78"
                          stroke-width="2.5" stroke-linecap="round"/>

                    <!-- Mata dan senyum -->
                    <circle cx="97" cy="54" r="2" fill="#173D61"/>
                    <circle cx="114" cy="54" r="2" fill="#173D61"/>
                    <path d="M99 65 Q106 71 114 64"
                          fill="none" stroke="#173D61"
                          stroke-width="2" stroke-linecap="round"/>

                    <!-- Simbol aksesibilitas -->
                    <circle cx="176" cy="35" r="15"
                            fill="#D0E8FF"/>
                    <path d="M168 36 L175 43 L185 28"
                          fill="none" stroke="#1673C9"
                          stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>

            <h1>Belajar Tanpa Batas<br>Raih Masa Depan</h1>

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

            <form action="#" method="POST" id="registerForm">

                @csrf

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3.5"/><path d="M5 20a7 7 0 0 1 14 0"/></svg>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            placeholder="Nama Lengkap"
                            autocomplete="name"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path d="m4.5 7 7.5 5.5L19.5 7"/></svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Email"
                            autocomplete="email"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomor_hp">Nomor HP</label>
                    <div class="input-wrapper">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6.5" y="2.5" width="11" height="19" rx="2"/><path d="M10 18.5h4"/></svg>
                        <input
                            type="tel"
                            id="nomor_hp"
                            name="nomor_hp"
                            placeholder="Nomor HP"
                            autocomplete="tel"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            autocomplete="new-password"
                            minlength="8"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Konfirmasi Password
                    </label>
                    <div class="input-wrapper">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            autocomplete="new-password"
                            minlength="8"
                            required>
                    </div>
                </div>

                <button type="submit" class="register-button">
                    Daftar
                </button>

                <p class="login-link">
                    Sudah punya akun?
                    <a href="{{ url('/login') }}">Login</a>
                </p>

            </form>

        </section>

    </main>

</body>
</html>