
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta | Web Pelatihan</title>

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

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--bg);
        }

        button, a {
            font: inherit;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .topbar {
            min-height: 78px;
            padding: 14px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            color: white;
            background: linear-gradient(110deg, #3976c6, #4687d4);
            box-shadow: 0 3px 12px #183e741a;
            position: sticky;
            top: 0;
            z-index: 10;
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
            font-size: 23px;
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
            font-size: 22px;
        }

        .layout {
            display: flex;
            min-height: calc(100vh - 78px);
        }

        .sidebar {
            width: 255px;
            flex-shrink: 0;
            padding: 32px 18px 22px;
            background: #f9fcff;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .nav-link {
            min-height: 54px;
            padding: 0 18px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-radius: 10px;
            color: #3c5b85;
            font-size: 14px;
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
            text-align: center;
            font-size: 21px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        /* Form logout */
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
        }

        .welcome {
            margin-bottom: 35px;
        }

        .welcome h1 {
            font-size: clamp(24px, 3vw, 34px);
            font-weight: 800;
            letter-spacing: -.8px;
            margin-bottom: 12px;
            color: #16386f;
        }

        .welcome p {
            color: var(--muted);
            font-size: 16px;
        }

        .notice {
            padding: 13px 17px;
            border-radius: 9px;
            margin-bottom: 22px;
            background: #e6f8ee;
            border: 1px solid #c7efd7;
            color: #187647;
            font-size: 14px;
            line-height: 1.5;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 42px;
        }

        .stat-card {
            min-height: 205px;
            padding: 25px 24px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: linear-gradient(145deg, #ffffff, #eef6ff);
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px #244d7a0c;
        }

        .stat-card.green {
            background: linear-gradient(145deg, #ffffff, #eafbf7);
            border-color: #d5f2eb;
        }

        .stat-card.purple {
            background: linear-gradient(145deg, #ffffff, #f2efff);
            border-color: #e7e0ff;
        }

        .stat-card.orange {
            background: linear-gradient(145deg, #ffffff, #fff8e9);
            border-color: #f8ead0;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #dcecff;
            color: #2476dc;
            display: grid;
            place-items: center;
            font-size: 26px;
            margin-bottom: 17px;
        }

        .green .stat-icon {
            background: #d8f6ef;
            color: #0c9c83;
        }

        .purple .stat-icon {
            background: #e9e2ff;
            color: #6e54d9;
        }

        .orange .stat-icon {
            background: #ffedca;
            color: #e99a20;
        }

        .stat-label {
            font-size: 14px;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 31px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #16386f;
        }

        .stat-note {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .section-heading {
            font-size: 27px;
            font-weight: 800;
            color: #16386f;
            margin-bottom: 24px;
        }

        .course-card {
            display: flex;
            align-items: center;
            gap: 30px;
            padding: 27px;
            background: #fff;
            border: 1px solid #d9e8fc;
            border-radius: 16px;
            box-shadow: 0 4px 16px #2e5b8b06;
        }

        .course-image {
            width: 220px;
            height: 175px;
            flex-shrink: 0;
            border-radius: 12px;
            background: #d8f5ff;
            display: grid;
            place-items: center;
            overflow: hidden;
        }

        .course-placeholder {
            font-size: 65px;
        }

        .course-info {
            flex: 1;
            min-width: 0;
        }

        .course-info h3 {
            font-size: 21px;
            margin-bottom: 13px;
            color: #16386f;
        }

        .course-category {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .progress-row {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .progress-track {
            height: 12px;
            background: #e9f0f9;
            border-radius: 30px;
            flex: 1;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 30%;
            border-radius: 30px;
            background: linear-gradient(90deg, #3282ef, #1767d5);
        }

        .progress-number {
            color: #3479d4;
            font-weight: 700;
            font-size: 14px;
        }

        .continue-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            flex-shrink: 0;
            padding: 13px 22px;
            color: white;
            background: linear-gradient(110deg, #3987f4, #216de0);
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .continue-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 14px #2878e844;
        }

        @media (max-width: 1150px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .course-card {
                flex-wrap: wrap;
            }

            .course-info {
                min-width: 220px;
            }
        }

        @media (max-width: 760px) {
            .topbar {
                min-height: 68px;
                padding: 12px 17px;
            }

            .brand {
                font-size: 19px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .profile {
                gap: 7px;
                font-size: 12px;
            }

            .profile-avatar {
                width: 34px;
                height: 34px;
                font-size: 17px;
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
                font-size: 17px;
                width: auto;
            }

            /* Logout tetap terlihat di HP */
            .sidebar-bottom {
                display: block;
                margin-top: 10px;
                padding-top: 10px;
            }

            .logout-button {
                justify-content: flex-start;
            }

            .main {
                padding: 28px 17px;
            }

            .welcome {
                margin-bottom: 25px;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .welcome p {
                font-size: 14px;
                line-height: 1.6;
            }

            .stats {
                gap: 12px;
                margin-bottom: 32px;
            }

            .stat-card {
                min-height: 170px;
                padding: 17px;
            }

            .stat-icon {
                width: 43px;
                height: 43px;
                font-size: 21px;
                margin-bottom: 13px;
            }

            .stat-label {
                font-size: 12px;
            }

            .stat-value {
                font-size: 26px;
            }

            .stat-note {
                font-size: 11px;
            }

            .section-heading {
                font-size: 23px;
            }

            .course-card {
                padding: 17px;
                gap: 18px;
            }

            .course-image {
                width: 100%;
                height: 180px;
            }

            .course-info {
                min-width: 100%;
            }

            .course-info h3 {
                font-size: 18px;
            }

            .progress-row {
                gap: 10px;
            }

            .continue-button {
                width: 100%;
            }
        }

        @media (max-width: 400px) {
            .brand {
                font-size: 16px;
                gap: 7px;
            }

            .profile {
                gap: 5px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <header class="topbar">
        <div class="brand">
            <span class="brand-icon">♿</span>
            <span>Web Pelatihan</span>
        </div>

        <div class="profile">
            <div class="profile-avatar">♙</div>
            <span>{{ auth()->user()->name }}</span>
            <span>⌄</span>
        </div>
    </header>

    <div class="layout">

        <aside class="sidebar">

            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <span class="nav-icon">⌂</span>
                    <span>Beranda</span>
                </a>

                <a href="#materi" class="nav-link">
                    <span class="nav-icon">▣</span>
                    <span>Materi</span>
                </a>

                <a href="#evaluasi" class="nav-link">
                    <span class="nav-icon">☑</span>
                    <span>Evaluasi</span>
                </a>

                <a href="#progres" class="nav-link">
                    <span class="nav-icon">▥</span>
                    <span>Progres</span>
                </a>

                <a href="#riwayat" class="nav-link">
                    <span class="nav-icon">◷</span>
                    <span>Riwayat</span>
                </a>

                <a href="#kompetensi" class="nav-link">
                    <span class="nav-icon">♙</span>
                    <span>Kompetensi</span>
                </a>
            </nav>

            <!-- TOMBOL LOGOUT: DESKTOP DAN HP -->
            <div class="sidebar-bottom">
                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                    onsubmit="return confirm('Apakah kamu yakin ingin logout?')"
                >
                    @csrf

                    <button type="submit" class="nav-link logout-button">
                        <span class="nav-icon">⇥</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

        </aside>

        <main class="main">

            <!-- Pesan setelah login atau tindakan lainnya -->
            @if (session('success'))
                <div class="notice" role="status">
                    {{ session('success') }}
                </div>
            @endif

            <section class="welcome">
                <h1>Halo, {{ auth()->user()->name }} 👋</h1>
                <p>Selamat datang di platform pelatihan!</p>
            </section>

            <section class="stats">

                <div class="stat-card">
                    <div class="stat-icon">▣</div>
                    <p class="stat-label">Materi Tersedia</p>
                    <div class="stat-value">5</div>
                    <p class="stat-note">Modul Pelatihan</p>
                </div>

                <div class="stat-card green">
                    <div class="stat-icon">☑</div>
                    <p class="stat-label">Progres Belajar</p>
                    <div class="stat-value">30%</div>
                    <p class="stat-note">Dari total materi</p>
                </div>

                <div class="stat-card purple">
                    <div class="stat-icon">✓</div>
                    <p class="stat-label">Evaluasi Selesai</p>
                    <div class="stat-value">2</div>
                    <p class="stat-note">Dari 5 evaluasi</p>
                </div>

                <div class="stat-card orange">
                    <div class="stat-icon">✿</div>
                    <p class="stat-label">Kompetensi</p>
                    <div class="stat-value">1</div>
                    <p class="stat-note">Kompetensi diperoleh</p>
                </div>

            </section>

            <section id="materi">
                <h2 class="section-heading">Pelatihan Terbaru</h2>

                <div class="course-card">

                    <div class="course-image">
                        <div class="course-placeholder" aria-label="Ilustrasi belajar">
                            🎨
                        </div>
                    </div>

                    <div class="course-info">
                        <h3>Dasar-Dasar Desain Grafis</h3>
                        <p class="course-category">
                            Kategori: Digital Skill
                        </p>

                        <div class="progress-row">
                            <div class="progress-track">
                                <div class="progress-fill"></div>
                            </div>

                            <span class="progress-number">30%</span>
                        </div>
                    </div>

                    <a href="#materi" class="continue-button">
                        ▶ Lanjutkan
                    </a>

                </div>
            </section>

        </main>

    </div>

</body>
</html>
