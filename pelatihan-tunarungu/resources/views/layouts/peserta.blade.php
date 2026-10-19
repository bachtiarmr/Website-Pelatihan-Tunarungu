<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Web Pelatihan') | Web Pelatihan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue: #2878e8;
            --blue-dark: #153e75;
            --text: #18345d;
            --muted: #6480a6;
            --bg: #f5f9ff;
            --border: #dce9fb;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            min-height: 100vh;
            background-color: var(--bg);
            background-image:
                linear-gradient(
                    rgba(245,249,255,.78),
                    rgba(245,249,255,.86)
                ),
                url('{{ asset('image/background2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input, select, textarea {
            font: inherit;
        }

        svg.icon {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* =========================
           NAVBAR
        ========================= */

        .topbar {
            min-height: 78px;
            padding: 14px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            color: white;
            background: linear-gradient(110deg, #2d6ae0, #4687d4);
            box-shadow: 0 3px 12px #183e741a;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 25px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border: 2px solid white;
            border-radius: 50%;
        }

        /* =========================
           PROFILE DROPDOWN
        ========================= */

        .profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .profile-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px;
            border: 1px solid transparent;
            border-radius: 12px;
            background: transparent;
            color: white;
            cursor: pointer;
            transition: background .2s, border-color .2s;
        }

        .profile-toggle:hover,
        .profile-toggle[aria-expanded="true"] {
            background: rgba(255,255,255,.14);
            border-color: rgba(255,255,255,.2);
        }

        .profile-toggle:focus-visible {
            outline: 2px solid white;
            outline-offset: 3px;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            background: white;
            color: var(--blue);
            display: grid;
            place-items: center;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .profile-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-chevron {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            transition: transform .2s;
        }

        .profile-toggle[aria-expanded="true"] .profile-chevron {
            transform: rotate(180deg);
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 270px;
            padding: 8px;
            background: #fff;
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 35px rgba(22, 56, 111, .18);
            z-index: 200;

            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-8px);

            transition:
                opacity .18s ease,
                transform .18s ease,
                visibility .18s;
        }

        .profile-dropdown.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }

        .profile-dropdown-header {
            padding: 13px 12px;
            border-bottom: 1px solid #eaf0f9;
            margin-bottom: 6px;
        }

        .profile-dropdown-name {
            display: block;
            color: #16386f;
            font-size: 14px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-dropdown-email {
            display: block;
            color: #6480a6;
            font-size: 12px;
            margin-top: 5px;
            overflow-wrap: anywhere;
        }

        .profile-dropdown-link {
            display: flex;
            align-items: center;
            gap: 11px;
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #345477;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
            transition: background .2s, color .2s;
        }

        .profile-dropdown-link:hover {
            background: #edf5ff;
            color: #1766d1;
        }

        .profile-dropdown-link:focus-visible {
            outline: 2px solid #3987f4;
            outline-offset: -2px;
        }

        .profile-dropdown-link svg {
            width: 19px;
            height: 19px;
            flex-shrink: 0;
        }

        .profile-dropdown-divider {
            height: 1px;
            background: #eaf0f9;
            margin: 6px 4px;
        }

        .profile-dropdown-link.logout-link {
            color: #d93636;
        }

        .profile-dropdown-link.logout-link:hover {
            background: #fff0f0;
            color: #b42318;
        }

        .profile-dropdown form {
            margin: 0;
        }

        /* =========================
           LAYOUT
        ========================= */

        .layout {
            display: flex;
            min-height: calc(100vh - 78px);
        }

        .sidebar {
            width: 295px;
            flex-shrink: 0;
            padding: 32px 20px 22px;
            background: rgba(249,252,255,.90);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-right: 1px solid rgba(220,233,251,.9);
            display: flex;
            flex-direction: column;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .nav-link {
            min-height: 60px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-radius: 12px;
            color: #3c5b85;
            font-size: 15px;
            font-weight: 600;
            transition: .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1766d1;
            background: #e0edff;
        }

        .nav-link.active {
            box-shadow: inset 0 -3px 0 #3986f5;
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        /* =========================
           SIDEBAR LOGOUT
        ========================= */

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        .logout-form {
            width: 100%;
        }

        .logout-button {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #fff0f0;
            color: #d93636;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main {
            flex: 1;
            min-width: 0;
            padding: 42px 38px;
            background: rgba(245,249,255,.20);
        }

        .notice {
            padding: 13px 17px;
            border-radius: 9px;
            margin-bottom: 22px;
            font-size: 14px;
            line-height: 1.5;
        }

        .notice.success {
            background: #e6f8ee;
            border: 1px solid #c7efd7;
            color: #187647;
        }

        .notice.error {
            background: #fff0f0;
            border: 1px solid #ffd2d2;
            color: #b42318;
        }

        .page-heading {
            margin-bottom: 28px;
        }

        .page-heading h1 {
            font-size: clamp(27px, 3vw, 36px);
            font-weight: 800;
            letter-spacing: -.8px;
            color: #16386f;
            margin-bottom: 12px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
        }

        .section-heading {
            font-size: 27px;
            font-weight: 800;
            color: #16386f;
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .section-header .section-heading {
            margin-bottom: 0;
        }

        .see-all {
            color: #2878e8;
            font-size: 14px;
            font-weight: 700;
        }

        .see-all:hover {
            text-decoration: underline;
        }

        .panel {
            background: rgba(255,255,255,.94);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 16px #2e5b8b0a;
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: 0;
            padding: 13px 22px;
            color: white;
            background: linear-gradient(110deg,#3987f4,#216de0);
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 14px #2878e844;
        }

        .form-control {
            width: 100%;
            min-height: 48px;
            padding: 12px 16px;
            border: 1px solid #d5e2f3;
            border-radius: 10px;
            background: rgba(255,255,255,.95);
            color: var(--text);
            outline: none;
        }

        .form-control:focus {
            border-color: #3987f4;
            box-shadow: 0 0 0 3px #3987f41a;
        }

        .empty-state {
            padding: 45px 20px;
            text-align: center;
            background: rgba(255,255,255,.92);
            border: 1px solid var(--border);
            border-radius: 16px;
            color: var(--muted);
        }

        .empty-state h3 {
            color: #16386f;
            margin-bottom: 9px;
            font-size: 18px;
        }

        .empty-state p {
            font-size: 14px;
            line-height: 1.7;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1100px) {
            .sidebar {
                width: 245px;
            }

            .main {
                padding: 32px 25px;
            }
        }

        @media (max-width: 760px) {
            body {
                background-attachment: scroll;
            }

            .topbar {
                min-height: 68px;
                padding: 12px 17px;
            }

            .brand {
                font-size: 19px;
                gap: 8px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
            }

            .profile {
                gap: 0;
            }

            .profile-toggle {
                gap: 6px;
                padding: 4px;
            }

            .profile-avatar {
                width: 36px;
                height: 36px;
            }

            .profile-name {
                max-width: 95px;
                font-size: 12px;
            }

            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 10px;
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .nav-menu {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 5px;
                width: 100%;
            }

            .nav-link {
                min-height: 43px;
                padding: 0 12px;
                gap: 7px;
                font-size: 12px;
            }

            .nav-icon {
                width: 20px;
                height: 20px;
            }

            .nav-icon svg {
                width: 18px;
                height: 18px;
            }

            .sidebar-bottom {
                margin-top: 10px;
                padding-top: 10px;
            }

            .main {
                padding: 28px 17px;
            }

            .page-heading h1 {
                font-size: 26px;
            }

            .page-heading p {
                font-size: 14px;
            }

            .section-heading {
                font-size: 23px;
            }

            .panel {
                padding: 17px;
            }

            .profile-dropdown {
                width: min(270px, calc(100vw - 24px));
                right: 0;
                top: calc(100% + 10px);
            }
        }

        @media (max-width: 400px) {
            .brand {
                font-size: 16px;
            }

            .profile-name {
                display: none;
            }

            .profile-toggle {
                gap: 4px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<header class="topbar">

    <a href="{{ route('dashboard') }}" class="brand">
        <span class="brand-icon">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
        </span>

        <span>E-Training.</span>
    </a>

    {{-- DROPDOWN PROFIL PESERTA --}}
    <div class="profile">

        <button
            type="button"
            class="profile-toggle"
            id="profileToggle"
            aria-expanded="false"
            aria-controls="profileMenu"
            aria-label="Buka menu profil"
        >
            <span class="profile-avatar">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </span>

            <span class="profile-name">
                {{ auth()->user()->name }}
            </span>

            <svg
                class="profile-chevron"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div
            class="profile-dropdown"
            id="profileMenu"
            aria-label="Menu profil"
        >

            <div class="profile-dropdown-header">
                <span class="profile-dropdown-name">
                    {{ auth()->user()->name }}
                </span>

                <span class="profile-dropdown-email">
                    {{ auth()->user()->email }}
                </span>
            </div>

            <a
                href="{{ route('peserta.pengaturan-akun.edit') }}"
                class="profile-dropdown-link"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                </svg>

                <span>Pengaturan Akun</span>
            </a>

            <div class="profile-dropdown-divider"></div>

            <form
                action="{{ route('logout') }}"
                method="POST"
                onsubmit="return confirm('Apakah kamu yakin ingin logout?')"
            >
                @csrf

                <button
                    type="submit"
                    class="profile-dropdown-link logout-link"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" x2="9" y1="12" y2="12"/>
                    </svg>

                    <span>Logout</span>
                </button>
            </form>

        </div>
    </div>

</header>

<div class="layout">

    <aside class="sidebar">

        <nav class="nav-menu">

            {{-- BERANDA --}}
            <a
                href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </span>

                <span>Beranda</span>
            </a>

            {{-- MATERI --}}
            <a
                href="{{ route('peserta.materi.index') }}"
                class="nav-link {{ request()->routeIs('peserta.materi.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </span>

                <span>Materi</span>
            </a>

            {{-- EVALUASI --}}
            <a
                href="{{ url('/evaluasi') }}"
                class="nav-link {{ request()->is('evaluasi*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect width="8" height="4" x="8" y="2" rx="1"/>
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                        <path d="m9 14 2 2 4-4"/>
                    </svg>
                </span>

                <span>Evaluasi</span>
            </a>

            {{-- PROGRES --}}
            <a
                href="{{ url('/progres') }}"
                class="nav-link {{ request()->is('progres*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 3v18h18"/>
                        <path d="M18 17V9M13 17V5M8 17v-3"/>
                    </svg>
                </span>

                <span>Progres</span>
            </a>

            {{-- RIWAYAT --}}
            <a
                href="{{ url('/riwayat') }}"
                class="nav-link {{ request()->is('riwayat*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5M12 7v5l4 2"/>
                    </svg>
                </span>

                <span>Riwayat</span>
            </a>

            {{-- KOMPETENSI --}}
            <a
                href="{{ url('/kompetensi') }}"
                class="nav-link {{ request()->is('kompetensi*') ? 'active' : '' }}"
            >
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="8" r="6"/>
                        <path d="m15.477 12.89 1.523 9.11-5-3-5 3 1.523-9.11"/>
                    </svg>
                </span>

                <span>Kompetensi</span>
            </a>

        </nav>

       

    </aside>

    <main class="main">

        {{-- NOTIFIKASI BERHASIL --}}
        @if (session('success'))
            <div class="notice success" role="status">
                {{ session('success') }}
            </div>
        @endif

        {{-- NOTIFIKASI ERROR --}}
        @if (session('error'))
            <div class="notice error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- VALIDASI FORM --}}
        @if ($errors->any())
            <div class="notice error" role="alert">
                <strong>Periksa kembali data yang dimasukkan:</strong>

                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ISI HALAMAN --}}
        @yield('content')

    </main>

</div>

@stack('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('profileToggle');
    const menu = document.getElementById('profileMenu');

    if (!toggle || !menu) {
        return;
    }

    function openMenu() {
        menu.classList.add('show');
        toggle.setAttribute('aria-expanded', 'true');
    }

    function closeMenu() {
        menu.classList.remove('show');
        toggle.setAttribute('aria-expanded', 'false');
    }

    function isOpen() {
        return menu.classList.contains('show');
    }

    toggle.addEventListener('click', function (event) {
        event.stopPropagation();

        if (isOpen()) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    menu.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    document.addEventListener('click', function (event) {
        if (
            !toggle.contains(event.target) &&
            !menu.contains(event.target)
        ) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && isOpen()) {
            closeMenu();
            toggle.focus();
        }
    });
});
</script>

</body>
</html>
