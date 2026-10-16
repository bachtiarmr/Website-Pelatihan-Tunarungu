@extends('admin.layout')

@section('title', 'Dashboard Admin - Web Pelatihan')

@section('content')

<h1 class="page-title">Dashboard Admin</h1>

<style>
    .stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 25px;
    }

    .stat-card {
        min-height: 90px;
        padding: 15px;
        border: 1px solid #e1eaf4;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 7px rgba(44, 80, 116, .06);
    }

    .stat-title {
        color: #55718d;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .stat-content {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .stat-icon {
        color: #3284dc;
        font-size: 23px;
    }

    .stat-number {
        color: #294866;
        font-size: 23px;
        font-weight: 700;
    }

    .activity-title {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .activity-icon {
        width: 28px;
        height: 28px;
        min-width: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8f3ff;
        color: #3182d5;
        border-radius: 50%;
    }

    .activity-text {
        color: #4d6781;
        font-size: 12px;
        line-height: 1.6;
    }

    .activity-time {
        display: block;
        color: #91a3b6;
        font-size: 11px;
    }

    @media (max-width: 500px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }
</style>

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

@endsection
