<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung semua materi yang sudah dipublikasikan
        $totalMateri = Materi::where('status', 'published')
            ->count();

        // Mengambil 5 materi terbaru yang sudah dipublikasikan
        $materiTerbaru = Materi::where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        // Mengirim data ke halaman beranda peserta
        return view('peserta.dashboard', [
            'totalMateri' => $totalMateri,
            'materiTerbaru' => $materiTerbaru,
        ]);
    }
}
