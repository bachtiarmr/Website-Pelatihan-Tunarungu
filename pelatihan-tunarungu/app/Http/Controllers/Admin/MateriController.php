<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $materi = Materi::query()
            ->when($request->filled('cari'), function ($query) use ($request) {
                $cari = $request->cari;
                $query->where(function ($q) use ($cari) {
                    $q->where('judul', 'like', "%{$cari}%")
                      ->orWhere('kategori', 'like', "%{$cari}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.materi.index', compact('materi'));
    }

    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['required', 'string', 'max:100'],
            'jenis' => ['required', Rule::in(['teks_foto', 'youtube', 'upload_video'])],
            'foto' => ['nullable', 'image', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:2048', 'required_if:jenis,youtube'],
            'video_file' => ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:51200', 'required_if:jenis,upload_video'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('materi/foto', 'public');
        }

        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('materi/video', 'public');
        }

        if ($data['jenis'] !== 'youtube') {
            $data['video_url'] = null;
        }

        if ($data['jenis'] !== 'upload_video') {
            $data['video_file'] = null;
        }

        if ($data['jenis'] === 'teks_foto') {
            $data['video_url'] = null;
            $data['video_file'] = null;
        }

        Materi::create($data);

        return redirect()
            ->route('admin.materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        return view('admin.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['required', 'string', 'max:100'],
            'jenis' => ['required', Rule::in(['teks_foto', 'youtube', 'upload_video'])],
            'foto' => ['nullable', 'image', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:2048', 'required_if:jenis,youtube'],
            'video_file' => ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:51200', 'required_if:jenis,upload_video'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($request->hasFile('foto')) {
            if ($materi->foto) {
                Storage::disk('public')->delete($materi->foto);
            }

            $data['foto'] = $request->file('foto')->store('materi/foto', 'public');
        } else {
            unset($data['foto']);
        }

        if ($request->hasFile('video_file')) {
            if ($materi->video_file) {
                Storage::disk('public')->delete($materi->video_file);
            }

            $data['video_file'] = $request->file('video_file')->store('materi/video', 'public');
        } elseif ($data['jenis'] === 'upload_video' && $materi->jenis === 'upload_video') {
            unset($data['video_file']);
        }

        if ($data['jenis'] !== 'youtube') {
            $data['video_url'] = null;
        }

        if ($data['jenis'] !== 'upload_video') {
            $data['video_file'] = null;
        }

        if ($data['jenis'] === 'teks_foto') {
            $data['video_url'] = null;
            $data['video_file'] = null;
        }

        $materi->update($data);

        return redirect()
            ->route('admin.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

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
