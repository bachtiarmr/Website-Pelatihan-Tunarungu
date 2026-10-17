<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilQuiz;
use App\Models\User;

class KompetensiController extends Controller
{
    public function index()
    {
        // Ambil peserta yang sudah memiliki hasil kuis.
        $peserta = User::where('role', 'peserta')
            ->whereHas('hasilQuizzes')
            ->withCount('hasilQuizzes')
            ->withAvg('hasilQuizzes', 'nilai')
            ->orderByDesc('hasil_quizzes_avg_nilai')
            ->orderBy('name')
            ->get();

        // Bagi menjadi 10 peserta teratas dan peserta lainnya.
        $peringkatAtas = $peserta->take(10);
        $peringkatLainnya = $peserta->skip(10);

        return view('admin.kompetensi.index', compact(
            'peringkatAtas',
            'peringkatLainnya'
        ));
    }
}
