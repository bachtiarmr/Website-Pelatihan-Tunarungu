@extends('layouts.peserta')

@section('title', 'Evaluasi Peserta')

@section('content')

<style>
    .eval-header { margin-bottom: 30px; }
    .eval-header h1 { font-size: 32px; font-weight: 800; color: #16386f; margin-bottom: 10px; }
    .eval-header p { color: #6480a6; font-size: 16px; line-height: 1.6; }
    .quiz-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; margin-top: 20px; }
    .quiz-card { background-color: #ffffff; border: 1px solid #dce9fb; border-radius: 16px; padding: 24px; display: flex; flex-direction: column; box-shadow: 0 4px 15px rgba(46, 91, 139, 0.05); position: relative; z-index: 10; }
    .quiz-card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; gap: 10px; }
    .quiz-title { font-size: 18px; font-weight: 700; color: #16386f; margin: 0; line-height: 1.4; }
    .quiz-badge { background: #e6f0ff; color: #1766d1; font-size: 11px; font-weight: 700; padding: 5px 12px; border-radius: 20px; white-space: nowrap; }
    .quiz-badge.done { background: #e6f8ee; color: #187647; }
    .quiz-desc { font-size: 14px; color: #6480a6; line-height: 1.6; margin-bottom: 20px; flex-grow: 1; }
    .quiz-meta { display: flex; gap: 20px; margin-bottom: 20px; padding-top: 15px; border-top: 1px solid #eaf0f9; }
    .quiz-meta-item { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #5c7593; font-weight: 600; }
    .quiz-meta-item svg { width: 18px; height: 18px; color: #8da2ba; }
    
    /* Tombol Card */
    .quiz-btn { display: flex; align-items: center; justify-content: center; width: 100%; padding: 12px; border-radius: 10px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.2s ease; border: none; cursor: pointer; }
    .quiz-btn-primary { background: linear-gradient(110deg, #3987f4, #216de0); color: white; }
    .quiz-btn-primary:hover { box-shadow: 0 4px 12px rgba(40, 120, 232, 0.3); }
    .quiz-btn-secondary { background: #f0f5fc; color: #1766d1; border: 1px solid #dce9fb; }
    .quiz-btn-secondary:hover { background: #e0edff; }
    .quiz-btn-disabled { background: #e2e8f0; color: #94a3b8; cursor: not-allowed; }

    /* ========================================= */
    /* CUSTOM MODAL STYLES (Tidak butuh Bootstrap) */
    /* ========================================= */
    .custom-modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(22, 56, 111, 0.5); /* Warna biru gelap transparan */
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .custom-modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    .custom-modal-box {
        background: #ffffff;
        border-radius: 20px;
        width: 90%;
        max-width: 420px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transform: translateY(20px) scale(0.95);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .custom-modal-overlay.show .custom-modal-box {
        transform: translateY(0) scale(1);
    }
    
    /* Ikon */
    .modal-icon-wrapper {
        width: 80px; height: 80px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
    }
    .modal-icon-wrapper.success { background: #e6f8ee; color: #187647; }
    .modal-icon-wrapper.error { background: #fff0f0; color: #d93636; }
    .modal-icon-wrapper svg { width: 40px; height: 40px; }

    .custom-modal-title {
        font-size: 24px;
        font-weight: 800;
        color: #16386f;
        margin-bottom: 10px;
    }
    .custom-modal-text {
        font-size: 15px;
        color: #6480a6;
        line-height: 1.6;
        margin-bottom: 25px;
    }
    .custom-modal-btn {
        background: linear-gradient(110deg, #3987f4, #216de0);
        color: #fff;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
        box-shadow: 0 4px 12px rgba(40, 120, 232, 0.3);
    }
    .custom-modal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(40, 120, 232, 0.4);
    }
</style>

<div class="eval-header">
    <h1>Evaluasi Peserta</h1>
    <p>Uji pemahaman Anda dengan mengerjakan kuis-kuis di bawah ini. Pastikan Anda sudah membaca materi terkait sebelum memulai.</p>
</div>

<div class="quiz-grid">
    @forelse($quizzes as $quiz)
        <div class="quiz-card">
            <div class="quiz-card-top">
                <h3 class="quiz-title">{{ $quiz->judul }}</h3>
                
                @if(isset($riwayat[$quiz->id]))
                    <span class="quiz-badge done">Selesai (Nilai: {{ round($riwayat[$quiz->id]->nilai) }})</span>
                @else
                    <span class="quiz-badge">Belum Dikerjakan</span>
                @endif
            </div>
            
            <p class="quiz-desc">{{ $quiz->deskripsi ?? 'Silakan kerjakan kuis ini untuk menguji pemahaman Anda.' }}</p>
            
            <div class="quiz-meta">
                <div class="quiz-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    <span>{{ $quiz->durasi_menit ?? '15' }} Menit</span>
                </div>
                <div class="quiz-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <span>{{ $quiz->soal_count }} Soal</span>
                </div>
            </div>

            @php
                $sudah_dikerjakan = isset($riwayat[$quiz->id]);
                $bisa_kerjakan = !$sudah_dikerjakan || $quiz->bisa_diulang;
            @endphp

            @if($bisa_kerjakan)
                <a href="{{ route('peserta.evaluasi.kerjakan', $quiz->id) }}" 
                   class="quiz-btn {{ $sudah_dikerjakan ? 'quiz-btn-secondary' : 'quiz-btn-primary' }}">
                    {{ $sudah_dikerjakan ? 'Kerjakan Ulang' : 'Mulai Kerjakan' }}
                </a>
            @else
                <button class="quiz-btn quiz-btn-disabled" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; margin-right: 6px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Sudah Dikerjakan
                </button>
            @endif
        </div>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6480a6;">
            <p>Belum ada kuis yang tersedia saat ini.</p>
        </div>
    @endforelse
</div>

<!-- ========================================== -->
<!-- CUSTOM POP-UP MODAL                        -->
<!-- ========================================== -->
@if(session('success') || session('error'))
    <div class="custom-modal-overlay" id="customNotifModal">
        <div class="custom-modal-box">
            
            @if(session('success'))
                <div class="modal-icon-wrapper success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h4 class="custom-modal-title">Kuis Selesai!</h4>
                <p class="custom-modal-text">{{ session('success') }}</p>
            @else
                <div class="modal-icon-wrapper error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
                <h4 class="custom-modal-title">Terjadi Kesalahan</h4>
                <p class="custom-modal-text">{{ session('error') }}</p>
            @endif

            <button type="button" class="custom-modal-btn" onclick="closeCustomModal()">
                Tutup
            </button>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('customNotifModal');
        
        if (modal) {
            // Tampilkan modal dengan jeda sedikit agar animasinya terlihat
            setTimeout(() => {
                modal.classList.add('show');
            }, 100);
        }
    });

    // Fungsi untuk menutup modal
    function closeCustomModal() {
        const modal = document.getElementById('customNotifModal');
        if (modal) {
            modal.classList.remove('show');
            // Opsional: hapus elemen dari DOM setelah animasi selesai
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
    }
</script>
@endpush