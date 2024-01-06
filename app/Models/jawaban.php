<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;
    protected $primaryKey = "id_jawaban";

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
        'jawwaban',
        'jika_benar',
    ];

        /**
     * jawaban
     *
     * @return void
     */
    public function jawaban()
    {
        return $this->belongsTo(jawaban::class, 'id_jawaban','id_jawaban');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(pertanyaan::class, 'id_pertanyaan','id_pertanyaan');
    }
}
