<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Web Pelatihan</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f7faff;
            color: #294866;
            font-size: 12px;
        }

        .app {
            display: flex;
            min-height: 100vh;
            border: 3px solid #dceaf6;
        }

        /* SIDEBAR */
        .sidebar {
            width: 120px;
            min-width: 120px;
            background: #f0f6fd;
            border-right: 1px solid #e0eaf4;
            display: flex;
            flex-direction: column;
        }

        .brand {
            height: 58px;
            padding: 0 17px;
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
            color: #294866;
        }

        .brand i {
            font-size: 16px;
            color: #416b91;
        }

        .menu {
            padding: 12px 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 9px;
            margin-bottom: 5px;
            border-radius: 7px;
            color: #56718b;
            text-decoration: none;
            font-size: 10px;
            font-weight: 500;
            white-space: nowrap;
            transition: .2s;
        }

        .menu a i {
            width: 13px;
            text-align: center;
            font-size: 12px;
        }

        .menu a:hover {
            background: #e1edfc;
            color: #246bc0;
        }

        .menu a.active {
            background: #d7e8ff;
            color: #2866a5;
            font-weight: 600;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 10px;
            border-top: 1px solid #e0eaf4;
        }

        .sidebar-bottom a {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 9px;
            text-decoration: none;
            color: #56718b;
            font-size: 10px;
            white-space: nowrap;
        }

        /* MAIN */
        .main {
            flex: 1;
            min-width: 0;
            background: #fff;
        }

        .topbar {
            height: 58px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 17px;
            border-bottom: 1px solid #e8eff6;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #385773;
            font-size: 10px;
            font-weight: 600;
        }

        .avatar {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: #e5effb;
            color: #365d82;
            font-size: 14px;
        }

        .profile .chevron {
            font-size: 9px;
            margin-left: 2px;
        }

        .content {
            padding: 20px 13px;
            max-width: 900px;
        }

        .page-title {
            font-size: 14px;
            font-weight: 700;
            color: #234664;
            margin-bottom: 15px;
        }

        /* STATISTICS */
        .stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 9px;
            margin-bottom: 18px;
        }

        .stat-card {
            min-height: 59px;
            padding: 9px 11px;
            border: 1px solid #e1eaf4;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 7px rgba(44, 80, 116, .06);
        }

        .stat-title {
            color: #55718d;
            font-size: 9px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon {
            color: #3284dc;
            font-size: 17px;
        }

        .stat-number {
            color: #294866;
            font-size: 14px;
            font-weight: 700;
        }

        /* ACTIVITY */
        .activity-title {
            font-size: 11px;
            font-weight: 700;
            color: #294866;
            margin-bottom: 12px;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .activity-icon {
            width: 17px;
            height: 17px;
            min-width: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f3ff;
            color: #3182d5;
            border-radius: 50%;
            font-size: 9px;
        }

        .activity-text {
            color: #4d6781;
            font-size: 9px;
            line-height: 1.5;
        }

        .activity-text strong {
            font-weight: 500;
        }

        .activity-time {
            display: block;
            color: #91a3b6;
            font-size: 8px;
        }

        form button[type="submit"] {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        form button[type="submit"]:hover {
            background-color: #bb2d3b;
        }

        @media (min-width: 700px) {
            .sidebar {
                width: 190px;
                min-width: 190px;
            }

            .brand {
                font-size: 13px;
                padding: 0 20px;
            }

            .menu a,
            .sidebar-bottom a {
                font-size: 12px;
                padding: 11px;
            }

            .content {
                padding: 25px;
            }

            .page-title {
                font-size: 20px;
            }

            .stat-card {
                padding: 13px;
                min-height: 80px;
            }

            .stat-title {
                font-size: 11px;
            }

            .stat-number {
                font-size: 18px;
            }

            .activity-title {
                font-size: 14px;
            }

            .activity-text {
                font-size: 11px;
            }

            .activity-time {
                font-size: 9px;
            }
        }

        @media (max-width: 360px) {
            .sidebar {
                width: 105px;
                min-width: 105px;
            }

            .brand {
                padding: 0 9px;
                font-size: 9px;
            }

            .menu {
                padding: 10px 5px;
            }

            .menu a {
                gap: 5px;
                padding: 8px 5px;
                font-size: 9px;
            }

            .content {
                padding: 15px 8px;
            }

            .stat-card {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="app">

        <!-- SIDEBAR ADMIN -->
        <aside class="sidebar">

            <div class="brand">
                <i class="fa-solid fa-ear-listen"></i>
                <span>Web Pelatihan</span>
            </div>

            <nav class="menu">
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.menu', ['menu' => 'peserta']) }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Peserta</span>
                </a>

                <a href="{{ route('admin.menu', ['menu' => 'materi']) }}">
                    <i class="fa-regular fa-clipboard"></i>
                    <span>Materi</span>
                </a>

                <a href="{{ route('admin.menu', ['menu' => 'quiz']) }}">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>Quiz</span>
                </a>

                <a href="{{ route('admin.menu', ['menu' => 'progres']) }}">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Progres</span>
                </a>

                <a href="{{ route('admin.menu', ['menu' => 'kompetensi']) }}">
                    <i class="fa-solid fa-award"></i>
                    <span>Kompetensi</span>
                </a>

                <a href="{{ route('admin.menu', ['menu' => 'laporan']) }}">
                    <i class="fa-regular fa-file-lines"></i>
                    <span>Laporan</span>
                </a>
            </nav>

            <div class="sidebar-bottom">
                <a href="{{ route('admin.menu', ['menu' => 'pengaturan']) }}">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    Logout
                </button>
            </form>


        </aside>

        <!-- KONTEN UTAMA -->
        <main class="main">

            <header class="topbar">
                <div class="profile">
                    <div class="avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <span>Admin</span>
                    <i class="fa-solid fa-chevron-down chevron"></i>
                </div>
            </header>

            <section class="content">

                <h1 class="page-title">Dashboard Admin</h1>

                <!-- STATISTIK -->
                <div class="stats">

                    <div class="stat-card">
                        <div class="stat-title">Total Peserta</div>
                        <div class="stat-content">
                            <i class="fa-solid fa-user stat-icon"></i>
                            <span class="stat-number">124</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-title">Materi Tersedia</div>
                        <div class="stat-content">
                            <i class="fa-solid fa-book-open stat-icon"></i>
                            <span class="stat-number">12</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-title">Peserta Aktif</div>
                        <div class="stat-content">
                            <i class="fa-solid fa-users stat-icon"></i>
                            <span class="stat-number">98</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-title">Kompetensi Tersedia</div>
                        <div class="stat-content">
                            <i class="fa-solid fa-award stat-icon"></i>
                            <span class="stat-number">8</span>
                        </div>
                    </div>

                </div>

                <!-- AKTIVITAS TERBARU -->
                <h2 class="activity-title">Aktivitas Terbaru</h2>

                <div class="activity-list">

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div class="activity-text">
                            <strong>Peserta baru mendaftar</strong>
                            <span class="activity-time">2 menit lalu</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div class="activity-text">
                            <strong>Andi Pratama menyelesaikan materi</strong>
                            <span class="activity-time">10 menit lalu</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div class="activity-text">
                            <strong>Quiz Desain Grafis selesai</strong>
                            <span class="activity-time">15 menit lalu</span>
                        </div>
                    </div>

                </div>

            </section>
        </main>
    </div>
</body>

</html>