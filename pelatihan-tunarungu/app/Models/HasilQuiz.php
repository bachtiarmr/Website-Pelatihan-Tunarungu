<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilQuiz extends Model
{
    protected $table = 'hasil_quizzes';

    protected $fillable = [
        'quiz_id',
        'peserta_id',
        'jumlah_benar',
        'jumlah_soal',
        'nilai',
        'status',
        'dikerjakan_pada',
    ];

    protected $casts = [
        'dikerjakan_pada' => 'datetime',
        'nilai' => 'decimal:2',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id');
    }
}
