<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\HasilQuiz;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EvaluasiController extends Controller
{
    // 1. Menampilkan daftar kuis
    public function index()
    {
        // PERBAIKAN: Menggunakan withCount('soal') sesuai nama relasi di Model Quiz
        $quizzes = Quiz::withCount('soal')->get();
        
        $riwayat = HasilQuiz::where('peserta_id', Auth::id())->get()->keyBy('quiz_id');

        return view('peserta.evaluasi.index', compact('quizzes', 'riwayat'));
    }

    // 2. Menampilkan halaman mengerjakan soal
    public function kerjakan(Quiz $quiz)
    {
        $soals = Soal::where('quiz_id', $quiz->id)->get();
        
        if ($soals->isEmpty()) {
            return redirect()->route('peserta.evaluasi.index')->with('error', 'Kuis ini belum memiliki soal.');
        }

        return view('peserta.evaluasi.kerjakan', compact('quiz', 'soals'));
    }

    // 3. Memproses jawaban dan menyimpan nilai
    public function submit(Request $request, Quiz $quiz)
    {
        $jawaban_peserta = $request->jawaban; 
        $soals = Soal::where('quiz_id', $quiz->id)->get();
        
        $jumlah_benar = 0;
        $jumlah_soal = $soals->count();

        foreach ($soals as $soal) {
            // PERBAIKAN: Menggunakan kolom 'jawaban_benar' dari migration Anda
            if (isset($jawaban_peserta[$soal->id]) && $jawaban_peserta[$soal->id] === $soal->jawaban_benar) {
                $jumlah_benar++;
            }
        }

        $nilai = ($jumlah_soal > 0) ? ($jumlah_benar / $jumlah_soal) * 100 : 0;

        HasilQuiz::updateOrCreate(
            [
                'quiz_id' => $quiz->id, 
                'peserta_id' => Auth::id()
            ],
            [
                'jumlah_benar' => $jumlah_benar,
                'jumlah_soal'  => $jumlah_soal,
                'nilai'        => $nilai,
                'status'       => 'selesai',
                'dikerjakan_pada' => Carbon::now(),
            ]
        );

        return redirect()->route('peserta.evaluasi.index')
                         ->with('success', "Kuis selesai! Nilai Anda: " . round($nilai) . " dari 100.");
    }
}