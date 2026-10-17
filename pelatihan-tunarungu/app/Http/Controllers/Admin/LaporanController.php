<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilQuiz;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal awal dan akhir laporan
        $awal = $request->input(
            'awal',
            Carbon::now()->startOfWeek()->toDateString()
        );

        $akhir = $request->input(
            'akhir',
            Carbon::now()->endOfWeek()->toDateString()
        );

        // Pastikan rentang tanggal valid
        $tanggalAwal = Carbon::parse($awal)->startOfDay();
        $tanggalAkhir = Carbon::parse($akhir)->endOfDay();

        // Ambil hasil kuis pada periode yang dipilih
        $hasilKuis = HasilQuiz::with(['peserta', 'quiz'])
            ->whereBetween('created_at', [
                $tanggalAwal,
                $tanggalAkhir
            ])
            ->latest('created_at')
            ->get();

        // Ringkasan laporan
        $totalPeserta = $hasilKuis
            ->pluck('peserta_id')
            ->unique()
            ->count();

        $totalHasilKuis = $hasilKuis->count();

        $rataRataNilai = $hasilKuis->isNotEmpty()
            ? $hasilKuis->avg('nilai')
            : 0;

        return view('admin.laporan.index', compact(
            'awal',
            'akhir',
            'hasilKuis',
            'totalPeserta',
            'totalHasilKuis',
            'rataRataNilai'
        ));
    }
}
