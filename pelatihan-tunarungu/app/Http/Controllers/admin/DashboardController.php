<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Materi;

class DashboardController extends Controller
{
    public function index()
    {
        // Total seluruh akun peserta
        $totalPeserta = User::where('role', 'peserta')->count();

        // Total semua materi yang tersimpan di database
        $totalMateri = Materi::count();

        return view('admin.dashboard', compact(
            'totalPeserta',
            'totalMateri'
        ));
    }
}
