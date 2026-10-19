@extends('layouts.peserta')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="settings-page">
    <div class="settings-heading">
        <div>
            <span class="settings-eyebrow">PENGATURAN PROFIL</span>
            <h1>Pengaturan Akun</h1>
            <p>Kelola informasi pribadi dan keamanan akun pelatihanmu.</p>
        </div>

        <div class="settings-heading-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <circle cx="12" cy="8" r="4"/>
                <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                <path d="M19 8h3M20.5 6.5v3"/>
            </svg>
        </div>
    </div>

    @if ($errors->any())
        <div class="settings-alert settings-alert-error" role="alert">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="settings-alert settings-alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('peserta.pengaturan-akun.update') }}"
        method="POST" class="settings-form">
        @csrf
        @method('PUT')

        {{-- Informasi profil --}}
        <section class="settings-card">
            <div class="settings-card-heading">
                <div class="settings-card-icon profile-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>
                </div>
                <div>
                    <h2>Informasi Profil</h2>
                    <p>Perbarui nama dan email yang digunakan pada akunmu.</p>
                </div>
            </div>

            <div class="settings-fields">
                <div class="settings-field">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $peserta->name) }}"
                        placeholder="Masukkan nama lengkap"
                        maxlength="255"
                        autocomplete="name"
                        required
                    >
                    @error('name')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $peserta->email) }}"
                        placeholder="nama@email.com"
                        maxlength="255"
                        autocomplete="email"
                        required
                    >
                    @error('email')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </section>

        {{-- Keamanan akun --}}
        <section class="settings-card">
            <div class="settings-card-heading">
                <div class="settings-card-icon security-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <div>
                    <h2>Keamanan Akun</h2>
                    <p>Kosongkan bagian password jika tidak ingin menggantinya.</p>
                </div>
            </div>

            <div class="settings-password-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 16v-4M12 8h.01"/>
                </svg>
                <span>
                    Untuk mengganti password, masukkan password lama terlebih
                    dahulu, kemudian isi password baru dan konfirmasinya.
                </span>
            </div>

            <div class="settings-fields">
                <div class="settings-field">
                    <label for="password_lama">Password Lama</label>
                    <div class="password-input-wrapper">
                        <input
                            type="password"
                            id="password_lama"
                            name="password_lama"
                            placeholder="Masukkan password lama"
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password"
                            data-target="password_lama"
                            aria-label="Tampilkan password lama"
                            aria-pressed="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19"
                                height="19" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_lama')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field">
                    <label for="password_baru">Password Baru</label>
                    <div class="password-input-wrapper">
                        <input
                            type="password"
                            id="password_baru"
                            name="password_baru"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password"
                            data-target="password_baru"
                            aria-label="Tampilkan password baru"
                            aria-pressed="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19"
                                height="19" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_baru')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field">
                    <label for="password_baru_confirmation">
                        Konfirmasi Password Baru
                    </label>
                    <div class="password-input-wrapper">
                        <input
                            type="password"
                            id="password_baru_confirmation"
                            name="password_baru_confirmation"
                            placeholder="Ulangi password baru"
                            autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password"
                            data-target="password_baru_confirmation"
                            aria-label="Tampilkan konfirmasi password"
                            aria-pressed="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19"
                                height="19" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <div class="settings-actions">
            <a href="{{ route('dashboard') }}" class="settings-btn-cancel">
                Batal
            </a>
            <button type="submit" class="settings-btn-save">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                    <path d="M17 21v-8H7v8M7 3v5h8"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .settings-page {
        max-width: 1000px;
        margin: 0 auto;
        padding-bottom: 32px;
        color: #1e293b;
    }

    .settings-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .settings-eyebrow {
        display: inline-block;
        margin-bottom: 8px;
        color: #2563eb;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
    }

    .settings-heading h1 {
        margin: 0 0 8px;
        color: #172554;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 800;
        letter-spacing: -0.8px;
    }

    .settings-heading p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
    }

    .settings-heading-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 62px;
        height: 62px;
        color: #2563eb;
        background: #dbeafe;
        border-radius: 18px;
    }

    .settings-form {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .settings-card {
        padding: 26px;
        background: #fff;
        border: 1px solid #e5eaf2;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.035);
    }

    .settings-card-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 22px;
        margin-bottom: 24px;
        border-bottom: 1px solid #eef2f7;
    }

    .settings-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 14px;
    }

    .profile-icon {
        color: #2563eb;
        background: #eff6ff;
    }

    .security-icon {
        color: #7c3aed;
        background: #f5f3ff;
    }

    .settings-card-heading h2 {
        margin: 0 0 5px;
        color: #1e293b;
        font-size: 17px;
        font-weight: 750;
    }

    .settings-card-heading p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
    }

    .settings-fields {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px 20px;
    }

    .settings-field {
        min-width: 0;
    }

    .settings-field label {
        display: block;
        margin-bottom: 9px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .settings-field input {
        box-sizing: border-box;
        width: 100%;
        min-height: 48px;
        padding: 12px 14px;
        color: #1e293b;
        font: inherit;
        font-size: 14px;
        background: #f8fafc;
        border: 1px solid #dbe3ee;
        border-radius: 11px;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .settings-field input::placeholder {
        color: #94a3b8;
    }

    .settings-field input:focus {
        background: #fff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-input-wrapper input {
        padding-right: 48px;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        color: #64748b;
        background: transparent;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transform: translateY(-50%);
    }

    .toggle-password:hover {
        color: #2563eb;
        background: #eff6ff;
    }

    .settings-password-info {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 15px;
        margin: 0 0 24px;
        color: #475569;
        font-size: 13px;
        line-height: 1.7;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
    }

    .settings-password-info svg {
        flex-shrink: 0;
        margin-top: 1px;
        color: #64748b;
    }

    .field-error {
        display: block;
        margin-top: 7px;
        color: #dc2626;
        font-size: 12px;
        line-height: 1.5;
    }

    .settings-alert {
        padding: 15px 18px;
        margin-bottom: 20px;
        font-size: 13px;
        line-height: 1.7;
        border-radius: 12px;
    }

    .settings-alert ul {
        padding-left: 20px;
        margin: 7px 0 0;
    }

    .settings-alert-error {
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .settings-alert-success {
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .settings-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        padding-top: 2px;
    }

    .settings-btn-cancel,
    .settings-btn-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 46px;
        padding: 0 19px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 750;
        text-decoration: none;
        border-radius: 11px;
        cursor: pointer;
        transition: background .2s, transform .2s, box-shadow .2s;
    }

    .settings-btn-cancel {
        color: #475569;
        background: #fff;
        border: 1px solid #dbe3ee;
    }

    .settings-btn-cancel:hover {
        background: #f8fafc;
    }

    .settings-btn-save {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
        box-shadow: 0 5px 12px rgba(37, 99, 235, .18);
    }

    .settings-btn-save:hover {
        background: #1d4ed8;
        box-shadow: 0 7px 16px rgba(37, 99, 235, .25);
        transform: translateY(-1px);
    }

    .settings-btn-save:focus-visible,
    .settings-btn-cancel:focus-visible,
    .toggle-password:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 3px;
    }

    @media (max-width: 650px) {
        .settings-heading {
            align-items: flex-start;
        }

        .settings-heading-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
        }

        .settings-card {
            padding: 20px 16px;
            border-radius: 15px;
        }

        .settings-card-heading {
            align-items: flex-start;
            gap: 11px;
        }

        .settings-card-icon {
            width: 42px;
            height: 42px;
        }

        .settings-fields {
            grid-template-columns: minmax(0, 1fr);
            gap: 18px;
        }

        .settings-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .settings-btn-cancel,
        .settings-btn-save {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(button.dataset.target);

            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            button.setAttribute('aria-pressed', String(isPassword));
            button.setAttribute(
                'aria-label',
                isPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    });
});
</script>
@endpush
