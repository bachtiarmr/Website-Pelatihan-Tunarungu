<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgresPelatihan extends Model
{
    protected $table = 'progres_pelatihans';

    protected $fillable = [
        'peserta_id',
        'materi_id',
        'status',
        'selesai_pada',
    ];

    protected function casts(): array
    {
        return [
            'selesai_pada' => 'datetime',
        ];
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(User::class, 'peserta_id');
    }

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
