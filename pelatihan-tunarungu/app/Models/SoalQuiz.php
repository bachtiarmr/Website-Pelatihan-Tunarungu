<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalQuiz extends Model
{
    protected $table = 'soal_quizzes';

    protected $fillable = [
        'quiz_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'nilai',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
