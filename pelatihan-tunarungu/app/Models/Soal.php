<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    // PERBAIKAN: Menyesuaikan dengan nama tabel database Anda
    protected $table = 'soal_quizzes';

    protected $fillable = [
        'quiz_id', 
        'pertanyaan', 
        'opsi_a', 
        'opsi_b', 
        'opsi_c', 
        'opsi_d', 
        'jawaban_benar', // PERBAIKAN: Menggunakan nama kolom database Anda
        'nilai'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}