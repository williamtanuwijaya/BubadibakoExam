<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sesi_ujian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_sesi_ujian';
        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_ujian',
        'sesi_ujian',
        'waktu_mulai',
        'waktu_selesai',
    ];

      /**
     * kelompok_ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompok_ujian()
    {
        return $this->hasMany(kelompok_ujian::class, 'id_sesi_ujian', 'id_sesi_ujian');
    }

    /**
     * ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function ujian()
    {
        return $this->belongsTo(ujian::class, 'id_ujian', 'id_ujian');
    }
}
