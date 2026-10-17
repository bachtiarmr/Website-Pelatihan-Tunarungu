<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPelatihan extends Model
{
    protected $table = 'kategori_pelatihan';

    protected $fillable = [
        'nama',
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kategori_id');
    }
}
