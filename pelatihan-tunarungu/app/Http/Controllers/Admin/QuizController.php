<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    /**
     * Menampilkan daftar quiz untuk admin.
     */
    public function index()
    {
        $quizzes = Quiz::with('materi')
            ->withCount('soal')
            ->latest()
            ->paginate(10);

        return view('admin.quiz.index', compact('quizzes'));
    }

    /**
     * Menampilkan form tambah quiz.
     */
    public function create()
    {
        $materi = Materi::orderBy('judul')->get();

        return view('admin.quiz.create', compact('materi'));
    }

    /**
     * Menyimpan quiz baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'materi_id' => ['nullable', 'exists:materi,id'],
            'status' => ['required', Rule::in(['draft', 'aktif'])],
        ]);

        $quiz = Quiz::create($data);

        return redirect()
            ->route('admin.quiz.index')
            ->with('success', 'Quiz berhasil disimpan.');
    }

    /**
     * Menampilkan form edit quiz dan daftar soalnya.
     */
    public function edit(Quiz $quiz)
    {
        $quiz->load('soal');

        $materi = Materi::orderBy('judul')->get();

        return view('admin.quiz.edit', compact('quiz', 'materi'));
    }

    /**
     * Memperbarui data quiz.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'materi_id' => ['nullable', 'exists:materi,id'],
            'status' => ['required', Rule::in(['draft', 'aktif'])],
        ]);

        $quiz->update($data);

        return redirect()
            ->route('admin.quiz.index')
            ->with('success', 'Quiz berhasil diperbarui.');
    }

    /**
     * Menghapus quiz.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()
            ->route('admin.quiz.index')
            ->with('success', 'Quiz berhasil dihapus.');
    }
}
