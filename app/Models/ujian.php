<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ujian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ujian';

    protected $fillable = [
        'nama_ujian',
        'id_mapel',
        'id_kelas',
        'durasi',
        'deskripsi',
        'pertanyaan_acak',
        'jawaban_acak',
        'hasil',
    ];

    public function mata_pelajaran()
    {
        return $this->belongsTo(mata_pelajaran::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }

    public function pertanyaan()
    {
        return $this->hasMany(pertanyaan::class, 'id_ujian', 'id_ujian');
    }
}
