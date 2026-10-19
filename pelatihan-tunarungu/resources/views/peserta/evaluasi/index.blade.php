@extends('layouts.peserta')

@section('title', 'Evaluasi Peserta')

@section('content')

{{-- STYLE LANGSUNG DI SINI AGAR PASTI TERBACA --}}
<style>
    .eval-header {
        margin-bottom: 30px;
    }
    .eval-header h1 {
        font-size: 32px;
        font-weight: 800;
        color: #16386f;
        margin-bottom: 10px;
    }
    .eval-header p {
        color: #6480a6;
        font-size: 16px;
        line-height: 1.6;
    }

    /* Grid Container */
    .quiz-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    /* Card Styling */
    .quiz-card {
        background-color: #ffffff; /* Warna solid putih */
        border: 1px solid #dce9fb;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 15px rgba(46, 91, 139, 0.05);
        transition: all 0.3s ease;
        position: relative;
        z-index: 10; /* Agar tidak tertutup background */
    }

    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(40, 120, 232, 0.15);
        border-color: #b5d3f7;
    }

    /* Header Card */
    .quiz-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
        gap: 10px;
    }

    .quiz-title {
        font-size: 18px;
        font-weight: 700;
        color: #16386f;
        margin: 0;
        line-height: 1.4;
    }

    .quiz-badge {
        background: #e6f0ff;
        color: #1766d1;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .quiz-badge.done {
        background: #e6f8ee;
        color: #187647;
    }

    /* Deskripsi */
    .quiz-desc {
        font-size: 14px;
        color: #6480a6;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    /* Meta Info (Waktu & Soal) */
    .quiz-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        padding-top: 15px;
        border-top: 1px solid #eaf0f9;
    }

    .quiz-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #5c7593;
        font-weight: 600;
    }

    .quiz-meta-item svg {
        width: 18px;
        height: 18px;
        color: #8da2ba;
    }

    /* Tombol Action */
    .quiz-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .quiz-btn-primary {
        background: linear-gradient(110deg, #3987f4, #216de0);
        color: white;
    }

    .quiz-btn-primary:hover {
        box-shadow: 0 4px 12px rgba(40, 120, 232, 0.3);
    }

    .quiz-btn-secondary {
        background: #f0f5fc;
        color: #1766d1;
        border: 1px solid #dce9fb;
    }

    .quiz-btn-secondary:hover {
        background: #e0edff;
    }
</style>

{{-- HEADER HALAMAN --}}
<div class="eval-header">
    <h1>Evaluasi Peserta</h1>
    <p>Uji pemahaman Anda dengan mengerjakan kuis-kuis di bawah ini. Pastikan Anda sudah membaca materi terkait sebelum memulai.</p>
</div>

{{-- GRID KUIS --}}
<div class="quiz-grid">
    
    {{-- CARD 1 --}}
    <div class="quiz-card">
        <div class="quiz-card-top">
            <h3 class="quiz-title">Evaluasi Dasar Komunikasi</h3>
            <span class="quiz-badge">Belum Dikerjakan</span>
        </div>
        <p class="quiz-desc">Menguji pemahaman Anda terkait materi dasar-dasar komunikasi efektif dan etika dalam berinteraksi.</p>
        
        <div class="quiz-meta">
            <div class="quiz-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                </svg>
                <span>15 Menit</span>
            </div>
            <div class="quiz-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                </svg>
                <span>20 Soal</span>
            </div>
        </div>

        <a href="{{ route('peserta.evaluasi.show', 1) }}" class="quiz-btn quiz-btn-primary">
            Mulai Kerjakan
        </a>
    </div>

    {{-- CARD 2 (Selesai) --}}
    <div class="quiz-card">
        <div class="quiz-card-top">
            <h3 class="quiz-title">Evaluasi Kewirausahaan</h3>
            <span class="quiz-badge done">Selesai</span>
        </div>
        <p class="quiz-desc">Tes pemahaman Anda mengenai konsep kewirausahaan, peluang bisnis, dan penyusunan rencana usaha.</p>
        
        <div class="quiz-meta">
            <div class="quiz-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                </svg>
                <span>30 Menit</span>
            </div>
            <div class="quiz-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                </svg>
                <span>25 Soal</span>
            </div>
        </div>

        <a href="#" class="quiz-btn quiz-btn-secondary">
            Lihat Hasil
        </a>
    </div>

</div>

@endsection