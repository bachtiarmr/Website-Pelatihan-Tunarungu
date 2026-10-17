<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'materi_id',
        'status',
    ];

    public function soal()
    {
        return $this->hasMany(SoalQuiz::class, 'quiz_id');
    }

    public function hasil()
    {
        return $this->hasMany(HasilQuiz::class, 'quiz_id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
