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
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border: 2px solid white;
            border-radius: 50%;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            background: white;
            color: var(--blue);
            display: grid;
            place-items: center;
            border-radius: 50%;
        }

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
                gap: 7px;
                font-size: 12px;
            }

            .profile-avatar {
                width: 34px;
                height: 34px;
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
        }

        @media (max-width: 400px) {
            .brand {
                font-size: 16px;
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
        <span>Web Pelatihan</span>
    </a>

    <div class="profile">
        <div class="profile-avatar">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>

        <span>{{ auth()->user()->name }}</span>
    </div>
</header>

<div class="layout">

    <aside class="sidebar">
        <nav class="nav-menu">

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </span>
                <span>Beranda</span>
            </a>

            <a href="{{ route('peserta.materi.index') }}"
               class="nav-link {{ request()->routeIs('peserta.materi.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </span>
                <span>Materi</span>
            </a>

            <a href="{{ url('/evaluasi') }}"
               class="nav-link {{ request()->is('evaluasi*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24">
                        <rect width="8" height="4" x="8" y="2" rx="1"/>
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                        <path d="m9 14 2 2 4-4"/>
                    </svg>
                </span>
                <span>Evaluasi</span>
            </a>

            <a href="{{ url('/progres') }}"
               class="nav-link {{ request()->is('progres*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3 3v18h18"/>
                        <path d="M18 17V9M13 17V5M8 17v-3"/>
                    </svg>
                </span>
                <span>Progres</span>
            </a>

            <a href="{{ url('/riwayat') }}"
               class="nav-link {{ request()->is('riwayat*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5M12 7v5l4 2"/>
                    </svg>
                </span>
                <span>Riwayat</span>
            </a>

            <a href="{{ url('/kompetensi') }}"
               class="nav-link {{ request()->is('kompetensi*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="icon" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="6"/>
                        <path d="m15.477 12.89 1.523 9.11-5-3-5 3 1.523-9.11"/>
                    </svg>
                </span>
                <span>Kompetensi</span>
            </a>

        </nav>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST"
                  class="logout-form"
                  onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
                @csrf

                <button type="submit" class="nav-link logout-button">
                    <span class="nav-icon">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" x2="9" y1="12" y2="12"/>
                        </svg>
                    </span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main">

        @if (session('success'))
            <div class="notice success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="notice error" role="alert">
                {{ session('error') }}
            </div>
        @endif

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

        @yield('content')

    </main>
</div>

@stack('scripts')

</body>
</html>