<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total seluruh akun peserta yang sudah mendaftar
        $totalPeserta = User::where('role', 'peserta')->count();

        return view('admin.dashboard', compact('totalPeserta'));
    }
}
