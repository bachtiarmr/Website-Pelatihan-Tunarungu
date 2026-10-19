<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Soal;

class SoalController extends Controller
{
    public function index(Quiz $quiz)
    {
        $soals = Soal::where('quiz_id', $quiz->id)->latest()->paginate(10);
        return view('admin.quiz.soal', compact('quiz', 'soals'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.quiz.create_soal', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'soal' => 'required|array',
            'soal.*.pertanyaan' => 'required|string',
            'soal.*.opsi_a' => 'required|string',
            'soal.*.opsi_b' => 'required|string',
            'soal.*.opsi_c' => 'required|string',
            'soal.*.opsi_d' => 'required|string',
            'soal.*.kunci' => 'required|in:A,B,C,D',
        ]);

        foreach ($request->soal as $data) {
            Soal::create([
                'quiz_id' => $quiz->id,
                'pertanyaan' => $data['pertanyaan'],
                'opsi_a' => $data['opsi_a'],
                'opsi_b' => $data['opsi_b'],
                'opsi_c' => $data['opsi_c'],
                'opsi_d' => $data['opsi_d'],
                'jawaban_benar' => $data['kunci'], 
            ]);
        }

        return redirect()->route('admin.quiz.soal.index', $quiz->id)
                         ->with('success', 'Semua soal berhasil ditambahkan!');
    }
}