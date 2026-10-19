<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Menggunakan 'peserta.evaluasi.index' sesuai struktur folder
        return view('peserta.evaluasi.index'); 
    }

    public function show($id)
    {
        // Nanti diisi logika untuk menampilkan soal
        return "Halaman Kerjakan Kuis ID: " . $id;
    }
}