<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi yang sudah dipublikasikan.
     */
    public function index(Request $request)
    {
        $cari = trim($request->query('cari', ''));

        $query = Materi::where('status', 'published');

        // Pencarian berdasarkan judul, kategori, atau deskripsi.
        if ($cari !== '') {
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                    ->orWhere('kategori', 'like', "%{$cari}%")
                    ->orWhere('deskripsi', 'like', "%{$cari}%");
            });
        }

        // Mengambil daftar kategori materi yang tersedia.
        $kategoriMateri = Materi::where('status', 'published')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        // Mengambil materi dengan pagination.
        $materi = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('peserta.materi.index', compact(
            'materi',
            'cari',
            'kategoriMateri'
        ));
    }

    /**
     * Menampilkan detail materi dan rekomendasi materi lainnya.
     */
    public function show(Materi $materi)
    {
        // Peserta hanya dapat membuka materi yang sudah dipublikasikan.
        abort_unless($materi->status === 'published', 404);

        // Mengambil maksimal 6 materi lain yang sudah dipublikasikan.
        $materiLainnya = Materi::where('status', 'published')
            ->where('id', '!=', $materi->id)
            ->latest()
            ->take(6)
            ->get();

        return view('peserta.materi.show', compact(
            'materi',
            'materiLainnya'
        ));
    }
}
