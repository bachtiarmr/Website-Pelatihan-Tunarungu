<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Web Pelatihan')</title>

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

        .sidebar {
            width: 190px;
            min-width: 190px;
            background: #f0f6fd;
            border-right: 1px solid #e0eaf4;
            display: flex;
            flex-direction: column;
        }

        .brand {
            min-height: 58px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .brand i {
            font-size: 16px;
            color: #416b91;
        }

        .menu {
            padding: 12px 10px;
        }

        .menu a,
        .sidebar-bottom a {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px;
            margin-bottom: 5px;
            border-radius: 7px;
            color: #56718b;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            transition: .2s;
        }

        .menu a i,
        .sidebar-bottom a i {
            width: 13px;
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
            padding: 10px;
            border-top: 1px solid #e0eaf4;
        }

        .logout-form {
            padding: 0 10px 10px;
        }

        .logout-form button {
            width: 100%;
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
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
            height: 58px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #e8eff6;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #385773;
            font-size: 12px;
            font-weight: 600;
        }

        .avatar {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e5effb;
            color: #365d82;
        }

        .content {
            padding: 25px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #234664;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 125px;
                min-width: 125px;
            }

            .brand {
                padding: 0 9px;
                font-size: 10px;
            }

            .menu {
                padding: 10px 5px;
            }

            .menu a,
            .sidebar-bottom a {
                gap: 5px;
                padding: 8px 5px;
                font-size: 10px;
            }

            .content {
                padding: 15px 10px;
            }

            .page-title {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>
<div class="app">

    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-ear-listen"></i>
            <span>Web Pelatihan</span>
        </div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.peserta.index') }}"
               class="{{ request()->routeIs('admin.peserta.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Peserta</span>
            </a>

            <a href="{{ route('admin.menu', ['menu' => 'materi']) }}"
               class="{{ request()->is('admin/menu/materi') ? 'active' : '' }}">
                <i class="fa-regular fa-clipboard"></i>
                <span>Materi</span>
            </a>

            <a href="{{ route('admin.menu', ['menu' => 'quiz']) }}"
               class="{{ request()->is('admin/menu/quiz') ? 'active' : '' }}">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Quiz</span>
            </a>

            <a href="{{ route('admin.menu', ['menu' => 'progres']) }}"
               class="{{ request()->is('admin/menu/progres') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-column"></i>
                <span>Progres</span>
            </a>

            <a href="{{ route('admin.menu', ['menu' => 'kompetensi']) }}"
               class="{{ request()->is('admin/menu/kompetensi') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Kompetensi</span>
            </a>

            <a href="{{ route('admin.menu', ['menu' => 'laporan']) }}"
               class="{{ request()->is('admin/menu/laporan') ? 'active' : '' }}">
                <i class="fa-regular fa-file-lines"></i>
                <span>Laporan</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ route('admin.menu', ['menu' => 'pengaturan']) }}"
               class="{{ request()->is('admin/menu/pengaturan') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan</span>
            </a>
        </div>

        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </aside>

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
