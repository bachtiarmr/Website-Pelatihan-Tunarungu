<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelatihan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriPelatihanController extends Controller
{
    public function index()
    {
        $kategori = KategoriPelatihan::latest()->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                'unique:kategori_pelatihan,nama',
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Kategori tersebut sudah tersedia.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
        ]);

        KategoriPelatihan::create($data);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(KategoriPelatihan $kategori)
    {
        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
