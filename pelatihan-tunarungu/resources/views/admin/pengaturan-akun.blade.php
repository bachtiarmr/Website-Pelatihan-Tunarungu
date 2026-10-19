
@extends('admin.layout')

@section('title', 'Pengaturan Akun Admin')

@section('content')
<div class="account-page">

    <div class="account-heading">
        <div>
            <h1>Pengaturan Akun</h1>
            <p>Kelola informasi profil dan keamanan akun administrator.</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="account-card">

        <div class="account-card-header">
            <div class="account-icon">
                <i class="fa-solid fa-user-gear"></i>
            </div>
            <div>
                <h2>Informasi Profil</h2>
                <p>Perbarui informasi akun administrator kamu.</p>
            </div>
        </div>

        <form action="{{ route('admin.pengaturan-akun.update') }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="section-label">
                <i class="fa-regular fa-id-card"></i>
                Data Administrator
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $admin->name) }}"
                           placeholder="Masukkan nama lengkap"
                           maxlength="255"
                           required>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $admin->email) }}"
                           placeholder="admin@email.com"
                           maxlength="255"
                           required>
                </div>
            </div>

            <div class="account-divider"></div>

            <div class="section-label">
                <i class="fa-solid fa-shield-halved"></i>
                Keamanan Password
            </div>

            <p class="password-note">
                Kosongkan bagian password jika tidak ingin menggantinya.
            </p>

            <div class="form-group">
                <label for="password_lama">Password Lama</label>
                <div class="password-wrapper">
                    <input type="password"
                           id="password_lama"
                           name="password_lama"
                           class="form-control"
                           placeholder="Masukkan password lama"
                           autocomplete="current-password">

                    <button type="button"
                            class="password-toggle"
                            data-target="password_lama"
                            aria-label="Tampilkan password lama">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password_baru">Password Baru</label>
                    <div class="password-wrapper">
                        <input type="password"
                               id="password_baru"
                               name="password_baru"
                               class="form-control"
                               placeholder="Minimal 8 karakter"
                               minlength="8"
                               autocomplete="new-password">

                        <button type="button"
                                class="password-toggle"
                                data-target="password_baru"
                                aria-label="Tampilkan password baru">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_baru_confirmation">
                        Konfirmasi Password Baru
                    </label>
                    <div class="password-wrapper">
                        <input type="password"
                               id="password_baru_confirmation"
                               name="password_baru_confirmation"
                               class="form-control"
                               placeholder="Ulangi password baru"
                               minlength="8"
                               autocomplete="new-password">

                        <button type="button"
                                class="password-toggle"
                                data-target="password_baru_confirmation"
                                aria-label="Tampilkan konfirmasi password">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="account-divider"></div>

            <div class="account-actions">
                <a href="{{ route('admin.dashboard') }}" class="cancel-button">
                    Batal
                </a>

                <button type="submit" class="save-button">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <div class="account-info">
        <i class="fa-solid fa-circle-info"></i>
        <span>Nama dan email yang diperbarui akan ditampilkan pada navbar admin.</span>
    </div>
</div>

<style>
.account-page {
    max-width: 1000px;
    margin: 0 auto;
}

.account-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.account-heading h1 {
    font-size: 25px;
    margin-bottom: 7px;
}

.account-heading p,
.account-card-header p {
    color: #8193a6;
    margin: 0;
    font-size: 12px;
}

.back-button,
.cancel-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 15px;
    border: 1px solid #dce7f2;
    border-radius: 8px;
    color: #45617b;
    text-decoration: none;
    background: white;
    font-size: 12px;
    white-space: nowrap;
}

.back-button:hover,
.cancel-button:hover {
    background: #f0f6fd;
    color: #246bc0;
}

.account-card {
    background: #fff;
    border: 1px solid #e3edf6;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(35, 70, 100, .05);
    padding: 28px;
}

.account-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding-bottom: 23px;
    margin-bottom: 24px;
    border-bottom: 1px solid #edf2f7;
}

.account-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    background: #eaf3ff;
    color: #3578bd;
    border-radius: 12px;
    font-size: 20px;
}

.account-card-header h2 {
    font-size: 17px;
    margin: 0 0 6px;
}

.section-label {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #315574;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 20px;
}

.section-label i { color: #4b82b4; }

.form-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
    min-width: 0;
}

.form-group label {
    display: block;
    color: #425f7a;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 9px;
}

.form-group .form-control {
    width: 100%;
    min-height: 43px;
    font-size: 12px;
}

.password-wrapper { position: relative; }

.password-wrapper .form-control { padding-right: 43px; }

.password-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    color: #8295a8;
    cursor: pointer;
    padding: 5px;
}

.password-toggle:hover { color: #2866a5; }

.password-note {
    color: #8496a8;
    font-size: 12px;
    margin: -8px 0 20px;
}

.account-divider {
    height: 1px;
    background: #edf2f7;
    margin: 5px 0 25px;
}

.account-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 5px;
}

.save-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border: none;
    border-radius: 8px;
    background: #3478bd;
    color: white;
    padding: 11px 17px;
    font-family: inherit;
    font-size: 12px;
    cursor: pointer;
}

.save-button:hover { background: #245f9d; }

.account-info {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: #68819a;
    font-size: 11px;
    line-height: 1.7;
    margin-top: 18px;
    padding: 14px 16px;
    background: #eef6ff;
    border-radius: 9px;
}

.account-info i { margin-top: 3px; color: #3478bd; }

@media (max-width: 600px) {
    .account-heading { align-items: flex-start; }
    .account-heading h1 { font-size: 20px; }
    .account-card { padding: 18px 14px; }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .account-actions { flex-direction: column-reverse; }

    .account-actions a,
    .account-actions button { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.password-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(button.dataset.target);
            const icon = button.querySelector('i');

            if (!input || !icon) return;

            const showPassword = input.type === 'password';
            input.type = showPassword ? 'text' : 'password';

            icon.classList.toggle('fa-eye', !showPassword);
            icon.classList.toggle('fa-eye-slash', showPassword);

            button.setAttribute(
                'aria-label',
                showPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    });
});
</script>
@endsection
