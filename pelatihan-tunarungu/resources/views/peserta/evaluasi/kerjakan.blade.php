@extends('layouts.peserta')

@section('title', 'Mengerjakan Kuis')

@section('content')

<style>
    /* --- HEADER & TIMER (Sticky) --- */
    .quiz-header { 
        display: flex; justify-content: space-between; align-items: center; 
        background: #fff; padding: 20px 25px; border-radius: 16px; 
        border: 1px solid #dce9fb; margin-bottom: 25px; position: sticky; 
        top: 90px; z-index: 10; box-shadow: 0 4px 15px rgba(46, 91, 139, 0.05);
    }
    .quiz-info h1 { font-size: 20px; font-weight: 800; color: #16386f; margin-bottom: 4px; }
    .quiz-info p { font-size: 14px; color: #6480a6; margin: 0; }
    
    .timer-box { 
        display: flex; align-items: center; gap: 10px; 
        background: #fff0f0; color: #d93636; padding: 10px 20px; 
        border-radius: 12px; font-size: 18px; font-weight: 800; border: 1px solid #ffd2d2; 
    }
    
    /* --- LAYOUT KONTEN --- */
    .quiz-container { display: flex; gap: 25px; align-items: flex-start; }
    .question-area { flex: 1; min-width: 0; }
    
    /* --- KARTU SOAL --- */
    .soal-card { 
        background: #fff; border: 1px solid #dce9fb; border-radius: 16px; 
        padding: 30px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(46, 91, 139, 0.05);
        scroll-margin-top: 180px; 
    }
    .question-header {
        display: flex; align-items: center; gap: 12px; 
        margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px dashed #eaf0f9;
    }
    .question-number { 
        font-size: 14px; font-weight: 700; color: #2878e8; 
        background: #e6f0ff; padding: 6px 14px; border-radius: 20px; 
    }
    .question-text { 
        font-size: 16px; font-weight: 600; color: #16386f; line-height: 1.6; margin-bottom: 25px; 
    }
    
    /* --- OPSI JAWABAN --- */
    .options-list { display: flex; flex-direction: column; gap: 12px; }
    .option-label { 
        display: flex; align-items: flex-start; gap: 15px; padding: 16px 20px; 
        border: 2px solid #eaf0f9; border-radius: 12px; cursor: pointer; 
        transition: all 0.2s ease; background: #fdfdfd; 
    }
    .option-label:hover { border-color: #b5d3f7; background: #f5f9ff; }
    .option-label input[type="radio"] { margin-top: 3px; width: 20px; height: 20px; accent-color: #2878e8; cursor: pointer; }
    .option-text { font-size: 15px; color: #345477; line-height: 1.5; }
    
    /* Warna saat radio dipilih */
    .option-label:has(input[type="radio"]:checked) { border-color: #2878e8; background: #e6f0ff; }
    
    /* --- NAVIGASI SOAL (Kanan) --- */
    .navigation-area { 
        width: 280px; flex-shrink: 0; background: #fff; border: 1px solid #dce9fb; 
        border-radius: 16px; padding: 25px; box-shadow: 0 4px 15px rgba(46, 91, 139, 0.05);
        position: sticky; top: 210px; 
    }
    .nav-title { font-size: 16px; font-weight: 700; color: #16386f; margin-bottom: 15px; }
    .question-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-bottom: 25px; }
    
    /* Default Tombol Navigasi */
    .q-nav-btn { 
        width: 100%; aspect-ratio: 1; display: flex; align-items: center; justify-content: center; 
        border-radius: 8px; font-size: 14px; font-weight: 700; border: 1px solid #dce9fb; 
        background: #f5f9ff; color: #6480a6; cursor: pointer; transition: all 0.2s; 
    }
    .q-nav-btn:hover { background: #e0edff; color: #1766d1; }
    
    /* Warna Tombol Navigasi yang Sedang Aktif (Diklik) */
    .q-nav-btn.active { background: #2878e8; color: #fff; border-color: #2878e8; }
    
    /* Warna Tombol Navigasi yang SUDAH DIJAWAB */
    .q-nav-btn.answered { 
        background: #e6f8ee; 
        color: #187647; 
        border-color: #c7efd7; 
        font-weight: 800;
    }

    /* Jika tombol aktif DAN sudah dijawab */
    .q-nav-btn.active.answered {
        background: #187647; /* Warna hijau tua */
        color: #fff;
        border-color: #187647;
    }
    
    /* Tombol Submit */
    .btn-submit { 
        width: 100%; padding: 14px; border-radius: 10px; font-size: 15px; font-weight: 700; 
        cursor: pointer; border: none; transition: all 0.2s; 
        background: linear-gradient(110deg, #3987f4, #216de0); 
        color: white; box-shadow: 0 4px 12px rgba(40, 120, 232, 0.3);
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(40, 120, 232, 0.4); }

    @media (max-width: 900px) {
        .quiz-container { flex-direction: column-reverse; }
        .navigation-area { width: 100%; position: static; margin-bottom: 20px; }
        .quiz-header { flex-direction: column; align-items: flex-start; gap: 15px; position: static; }
    }
</style>

<!-- HEADER KUIS -->
<div class="quiz-header">
    <div class="quiz-info">
        <h1>{{ $quiz->judul }}</h1>
        <p>Total {{ $soals->count() }} Soal. Kerjakan dengan teliti.</p>
    </div>
    
    <div class="timer-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        <span id="timer-display">{{ $quiz->durasi_menit }}:00</span>
    </div>
</div>

<form action="{{ route('peserta.evaluasi.submit', $quiz->id) }}" method="POST" id="form-kuis">
    @csrf
    <div class="quiz-container">
        
        <!-- KIRI: DAFTAR SOAL -->
        <div class="question-area">
            @foreach($soals as $index => $soal)
                <div class="soal-card" id="soal-{{ $index + 1 }}">
                    <div class="question-header">
                        <span class="question-number">Soal {{ $index + 1 }} dari {{ $soals->count() }}</span>
                    </div>
                    
                    <div class="question-text">{{ $soal->pertanyaan }}</div>

                    <div class="options-list">
                        <!-- Tambahkan onchange="markAsAnswered(index)" pada setiap radio -->
                        <label class="option-label">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="A" onchange="markAsAnswered({{ $index + 1 }})">
                            <span class="option-text"><strong>A.</strong> {{ $soal->opsi_a }}</span>
                        </label>
                        <label class="option-label">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="B" onchange="markAsAnswered({{ $index + 1 }})">
                            <span class="option-text"><strong>B.</strong> {{ $soal->opsi_b }}</span>
                        </label>
                        <label class="option-label">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="C" onchange="markAsAnswered({{ $index + 1 }})">
                            <span class="option-text"><strong>C.</strong> {{ $soal->opsi_c }}</span>
                        </label>
                        <label class="option-label">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="D" onchange="markAsAnswered({{ $index + 1 }})">
                            <span class="option-text"><strong>D.</strong> {{ $soal->opsi_d }}</span>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- KANAN: NAVIGASI -->
        <div class="navigation-area">
            <div class="nav-title">Navigasi Soal</div>
            <div class="question-grid" id="nav-grid">
                @foreach($soals as $index => $soal)
                    <button type="button" class="q-nav-btn" id="nav-btn-{{ $index + 1 }}" onclick="scrollToSoal({{ $index + 1 }}, this)">
                        {{ $index + 1 }}
                    </button>
                @endforeach
            </div>

            <button type="submit" class="btn-submit" onclick="return confirm('Kumpulkan jawaban sekarang? Pastikan semua sudah terisi.')">
                Kumpulkan Jawaban
            </button>
        </div>
        
    </div>
</form>

@endsection

@push('scripts')
<script>
    // 1. Fungsi Scroll ke Soal
    function scrollToSoal(index, btnElement) {
        const targetSoal = document.getElementById('soal-' + index);
        if (targetSoal) {
            targetSoal.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            document.querySelectorAll('.q-nav-btn').forEach(el => el.classList.remove('active'));
            btnElement.classList.add('active');
        }
    }

    // 2. Fungsi Menandai Tombol Navigasi Jika Dijawab
    function markAsAnswered(index) {
        const navBtn = document.getElementById('nav-btn-' + index);
        if (navBtn) {
            // Tambahkan class 'answered' (warna hijau)
            navBtn.classList.add('answered');
        }
    }

    // 3. Logika Timer Countdown
    let timeLeft = {{ $quiz->durasi_menit }} * 60;
    const timerDisplay = document.getElementById('timer-display');

    const timerInterval = setInterval(function() {
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert('Waktu habis! Jawaban akan dikumpulkan otomatis.');
            document.getElementById('form-kuis').submit();
            return;
        }
        
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        timeLeft--;
    }, 1000);
</script>
@endpush