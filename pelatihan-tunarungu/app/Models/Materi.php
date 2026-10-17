<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'jenis',
        'foto',
        'video_url',
        'video_file',
        'status',
    ];
}
