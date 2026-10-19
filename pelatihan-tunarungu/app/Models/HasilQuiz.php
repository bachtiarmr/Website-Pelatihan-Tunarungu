<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilQuiz extends Model
{
    use HasFactory;

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

    // Relasi ke User
    public function peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id');
    }

    // Relasi ke Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}