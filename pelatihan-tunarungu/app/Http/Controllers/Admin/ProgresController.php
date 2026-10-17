<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProgresPelatihan;
use App\Models\HasilQuiz;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function index(Request $request)
    {
        $peserta = User::where('role', 'peserta')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $cari = $request->cari;

                $query->where(function ($q) use ($cari) {
                    $q->where('name', 'like', "%{$cari}%")
                      ->orWhere('email', 'like', "%{$cari}%");
                });
            })
            ->withCount([
                'progresPelatihans as materi_selesai' => function ($query) {
                    $query->where('status', 'selesai');
                }
            ])
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $progresMateri = ProgresPelatihan::with(['peserta', 'materi'])
            ->where('status', 'selesai')
            ->latest('selesai_pada')
            ->get();

        $hasilQuiz = HasilQuiz::with(['peserta', 'quiz'])
            ->latest()
            ->get();

        return view('admin.progres.index', compact(
            'peserta',
            'progresMateri',
            'hasilQuiz'
        ));
    }
}
