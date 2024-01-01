<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelompok_ujian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kelompok_ujian';
      /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_ujian',
        'id_sesi_ujian',
        'id_pelajar',
    ];

      /**
     * ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ujian()
    {
        return $this->belongsTo(ujian::class, 'id_ujian');
    }

      /**
     * sesi_ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sesi_ujian()
    {
        return $this->belongsTo(sesi_ujian::class, 'id_sesi_ujian');
    }

    /**
     * peelajar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pelajar()
    {
        return $this->belongsTo(pelajar::class);
    }
}
