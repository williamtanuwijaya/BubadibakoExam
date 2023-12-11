<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
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
        'id_pelajar',
        'durasi',
        'waktu_mulai',
        'waktu_selesai',
        'total_benar',
        'nilai',
    ];

        /**
     * ujian
     *
     * @return void
     */
    public function ujian()
    {
        return $this->belongsTo(ujian::class);
    }

     /**
     * sesi_ujian
     *
     * @return void
     */
    public function sesi_ujian()
    {
        return $this->belongsTo(sesi_ujian::class);
    }

      /**
     * pelajar
     *
     * @return void
     */
    public function pelajar()
    {
        return $this->belongsTo(pelajar::class);
    }
}
