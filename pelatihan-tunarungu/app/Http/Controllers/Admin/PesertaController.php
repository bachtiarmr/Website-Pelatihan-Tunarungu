<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Menampilkan daftar peserta yang sudah registrasi
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
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPeserta = User::where('role', 'peserta')->count();

        return view('admin.peserta.index', compact(
            'peserta',
            'totalPeserta'
        ));
    }

    // Menampilkan detail peserta
    public function show(User $pesertum)
    {
        abort_unless($pesertum->role === 'peserta', 404);

        return view('admin.peserta.show', [
            'peserta' => $pesertum,
        ]);
    }
}