<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // PASTIKAN 'durasi_menit' ADA DI SINI
    protected $fillable = [
    'judul', 
    'deskripsi', 
    'materi_id', 
    'status', 
    'durasi_menit',
    'bisa_diulang' // <-- Tambahkan ini
];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function soal()
    {
        return $this->hasMany(Soal::class, 'quiz_id'); 
    }

    public function hasil_quiz()
    {
        return $this->hasMany(HasilQuiz::class);
    }
}