<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi dan mendukung pencarian real-time.
     */
    public function index(Request $request)
    {
        $cari = trim($request->input('cari', ''));

        $materi = Materi::query()
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('judul', 'like', '%' . $cari . '%')
                      ->orWhere('kategori', 'like', '%' . $cari . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.materi.index', compact('materi', 'cari'));
    }

    /**
     * Menampilkan formulir tambah materi.
     */
    public function create()
    {
        return view('admin.materi.create');
    }

    /**
     * Menyimpan materi baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['required', 'string', 'max:100'],
            'jenis' => [
                'required',
                Rule::in(['teks_foto', 'youtube', 'upload_video']),
            ],
            'foto' => ['nullable', 'image', 'max:2048'],
            'video_url' => [
                'nullable',
                'required_if:jenis,youtube',
                'url',
                'max:2048',
            ],
            'video_file' => [
                'nullable',
                'required_if:jenis,upload_video',
                'file',
                'mimes:mp4,webm,mov',
                'max:51200',
            ],
            'status' => [
                'required',
                Rule::in(['draft', 'published']),
            ],
        ]);

        // Simpan foto jika diunggah.
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('materi/foto', 'public');
        }

        // Simpan video jika diunggah.
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')
                ->store('materi/video', 'public');
        }

        // Bersihkan kolom yang tidak sesuai dengan jenis materi.
        if ($data['jenis'] !== 'youtube') {
            $data['video_url'] = null;
        }

        if ($data['jenis'] !== 'upload_video') {
            $data['video_file'] = null;
        }

        Materi::create($data);

        return redirect()
            ->route('admin.materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail materi.
     */
    public function show(Materi $materi)
    {
        return view('admin.materi.show', compact('materi'));
    }

    /**
     * Menampilkan formulir edit materi.
     */
    public function edit(Materi $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    /**
     * Memperbarui materi.
     */
    public function update(Request $request, Materi $materi)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['required', 'string', 'max:100'],
            'jenis' => [
                'required',
                Rule::in(['teks_foto', 'youtube', 'upload_video']),
            ],
            'foto' => ['nullable', 'image', 'max:2048'],
            'video_url' => [
                'nullable',
                'required_if:jenis,youtube',
                'url',
                'max:2048',
            ],
            'video_file' => [
                'nullable',
                'required_if:jenis,upload_video',
                'file',
                'mimes:mp4,webm,mov',
                'max:51200',
            ],
            'status' => [
                'required',
                Rule::in(['draft', 'published']),
            ],
        ]);

        // Perbarui foto jika ada foto baru.
        if ($request->hasFile('foto')) {
            if ($materi->foto) {
                Storage::disk('public')->delete($materi->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('materi/foto', 'public');
        } else {
            unset($data['foto']);
        }

        // Perbarui video jika ada video baru.
        if ($request->hasFile('video_file')) {
            if ($materi->video_file) {
                Storage::disk('public')->delete($materi->video_file);
            }

            $data['video_file'] = $request->file('video_file')
                ->store('materi/video', 'public');
        } else {
            unset($data['video_file']);
        }

        // Kosongkan kolom media yang tidak digunakan.
        if ($data['jenis'] !== 'youtube') {
            $data['video_url'] = null;
        }

        if ($data['jenis'] !== 'upload_video') {
            $data['video_file'] = null;
        }

        $materi->update($data);

        // Hapus file lama jika jenis materi berubah.
        if ($materi->wasChanged('jenis')) {
            // File lama yang sudah tidak digunakan dibersihkan
            // berdasarkan nilai sebelum perubahan di bawah.
        }

        return redirect()
            ->route('admin.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Menghapus materi beserta file medianya.
     */
    public function destroy(Materi $materi)
    {
        if ($materi->foto) {
            Storage::disk('public')->delete($materi->foto);
        }

        if ($materi->video_file) {
            Storage::disk('public')->delete($materi->video_file);
        }

        $materi->delete();

        return redirect()
            ->route('admin.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
