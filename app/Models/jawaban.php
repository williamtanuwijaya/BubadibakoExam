<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;

      /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_ujian',
        'id_sesi_ujian',
        'id_pertanyaan',
        'id_pelajar',
        'urutan_pertanyaan',
        'urutan_jawaban',
        'jawaban',
        'jika_benar',
    ];

        /**
     * jawaban
     *
     * @return void
     */
    public function jawaban()
    {
        return $this->belongsTo(jawaban::class);
    }
}
