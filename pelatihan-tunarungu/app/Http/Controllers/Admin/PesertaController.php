<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'peserta');

        if ($request->filled('cari')) {
            $cari = $request->input('cari');

            $query->where(function ($q) use ($cari) {
                $q->where('name', 'like', "%{$cari}%")
                  ->orWhere('email', 'like', "%{$cari}%");
            });
        }

        $peserta = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPeserta = User::where('role', 'peserta')->count();

        if ($request->ajax()) {
            return view(
                'admin.peserta.partials.table',
                compact('peserta')
            );
        }

        return view('admin.peserta.index', compact(
            'peserta',
            'totalPeserta'
        ));
    }

    public function show(User $pesertum)
    {
        abort_unless($pesertum->role === 'peserta', 404);

        return view('admin.peserta.show', [
            'peserta' => $pesertum,
        ]);
    }
}
