<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ujian extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
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

       /**
     * lesson
     *
     * @return void
     */
    public function mata_pelajaran()
    {
        return $this->belongsTo(mata_pelajaran::class);
    }

    /**
     * kelas
     *
     * @return void
     */
    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

      /**
     * pertanyaan
     *
     * @return void
     */
    public function peertanyaan()
    {
        return $this->hasMany(pertanyaan::class)->orderBy('id', 'DESC');
    }
}
