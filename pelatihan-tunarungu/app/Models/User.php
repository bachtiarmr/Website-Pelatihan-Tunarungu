<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nomor_hp',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi progres pelatihan milik peserta.
     */
    public function progresPelatihans(): HasMany
    {
        return $this->hasMany(
            ProgresPelatihan::class,
            'peserta_id'
        );
    }

    /**
     * Relasi hasil quiz milik peserta.
     */
    public function hasilQuizzes(): HasMany
    {
        return $this->hasMany(
            HasilQuiz::class,
            'peserta_id'
        );
    }
}
