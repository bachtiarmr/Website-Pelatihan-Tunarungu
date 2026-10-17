<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin - Web Pelatihan')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            font-size: 13px;
        }

        .app {
            display: flex;
            min-height: 100vh;
            border: 3px solid #dceaf6;
        }

        .sidebar {
            width: 250px;
            min-width: 250px;
            background: #f0f6fd;
            border-right: 1px solid #e0eaf4;
            display: flex;
            flex-direction: column;
        }

        .brand {
            min-height: 76px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            white-space: nowrap;
            color: #294866;
        }

        .brand i {
            font-size: 20px;
            color: #416b91;
        }

        .menu {
            padding: 16px 10px;
        }

        .menu a,
        .sidebar-bottom a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            margin-bottom: 6px;
            border-radius: 9px;
            color: #56718b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background .2s, color .2s;
        }

        .menu a i,
        .sidebar-bottom a i {
            width: 18px;
            text-align: center;
        }

        .menu a:hover,
        .sidebar-bottom a:hover {
            background: #e1edfc;
            color: #246bc0;
        }

        .menu a.active,
        .sidebar-bottom a.active {
            background: #d7e8ff;
            color: #2866a5;
            font-weight: 600;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 12px 10px;
            border-top: 1px solid #e0eaf4;
        }

        .logout-form {
            padding: 0 10px 12px;
        }

        .logout-form button {
            width: 100%;
            background: #dc3545;
            color: white;
            border: none;
            padding: 13px;
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
        }

        .logout-form button:hover {
            background: #bb2d3b;
        }

        .main {
            flex: 1;
            min-width: 0;
            background: #fff;
        }

        .topbar {
            min-height: 76px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid #e8eff6;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #385773;
            font-size: 14px;
            font-weight: 600;
        }

        .avatar {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e5effb;
            color: #365d82;
        }

        .content {
            padding: 30px;
        }

        .content h1,
        .content h2,
        .content h3 {
            color: #234664;
            font-weight: 700;
        }

        .content .card {
            border: 1px solid #e4edf6;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(35, 70, 100, .05);
        }

        .content .btn {
            border-radius: 7px;
            font-family: inherit;
            font-size: 13px;
            padding: 9px 14px;
        }

        .content .form-control,
        .content .form-select {
            border-color: #d8e3ef;
            border-radius: 7px;
            padding: 10px 12px;
            font-family: inherit;
            font-size: 13px;
        }

        .content .form-control:focus,
        .content .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .12);
        }

        .content .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .content .table {
            font-size: 13px;
            vertical-align: middle;
        }

        .content .table thead th {
            background: #f0f6fd;
            color: #385773;
            white-space: nowrap;
            padding: 14px;
        }

        .content .table tbody td {
            padding: 13px;
        }

        .content .alert {
            border-radius: 8px;
        }

        .content p {
            line-height: 1.7;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 175px;
                min-width: 175px;
            }

            .brand {
                padding: 0 12px;
                font-size: 13px;
            }

            .menu a,
            .sidebar-bottom a {
                gap: 8px;
                padding: 11px 8px;
                font-size: 12px;
            }

            .content {
                padding: 20px 14px;
            }

            .topbar {
                padding: 0 15px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 125px;
                min-width: 125px;
            }

            .brand {
                padding: 0 8px;
                font-size: 10px;
                gap: 5px;
            }

            .brand i {
                font-size: 14px;
            }

            .menu {
                padding: 10px 5px;
            }

            .menu a,
            .sidebar-bottom a {
                gap: 5px;
                padding: 9px 5px;
                font-size: 10px;
            }

            .content {
                padding: 15px 10px;
            }

            .profile {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <i class="fa-solid fa-ear-listen"></i>
            <span>Web Pelatihan</span>
        </div>

        <nav class="menu">

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <!-- PESERTA -->
            <a href="{{ route('admin.peserta.index') }}"
               class="{{ request()->routeIs('admin.peserta.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Peserta</span>
            </a>

            <!-- MATERI -->
            <a href="{{ route('admin.materi.index') }}"
               class="{{ request()->routeIs('admin.materi.*') ? 'active' : '' }}">
                <i class="fa-regular fa-clipboard"></i>
                <span>Materi</span>
            </a>

            <!-- QUIZ -->
            <a href="{{ route('admin.quiz.index') }}"
               class="{{ request()->routeIs('admin.quiz.*') ? 'active' : '' }}">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Quiz</span>
            </a>

            <!-- PROGRES -->
            <a href="{{ route('admin.progres.index') }}"
               class="{{ request()->routeIs('admin.progres.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-column"></i>
                <span>Progres</span>
            </a>

            <!-- KOMPETENSI -->
            <a href="{{ route('admin.kompetensi.index') }}"
               class="{{ request()->routeIs('admin.kompetensi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Kompetensi</span>
            </a>

            <!-- LAPORAN -->
            <a href="{{ route('admin.laporan.index') }}"
               class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="fa-regular fa-file-lines"></i>
                <span>Laporan</span>
            </a>

        </nav>

        <!-- PENGATURAN -->
        <div class="sidebar-bottom">
            <a href="{{ route('admin.menu', ['menu' => 'pengaturan']) }}"
               class="{{ request()->is('admin/menu/pengaturan') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan</span>
            </a>
        </div>

        <!-- LOGOUT -->
        <form class="logout-form"
              action="{{ route('logout') }}"
              method="POST">
            @csrf

            <button type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
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

                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>

    </main>

</div>
</body>
</html>
