<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelompok_ujian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelompok_ujian';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'id_ujian',
        'id_sesi_ujian',
        'id_pelajar',
    ];

    /**
     * Relationship with 'ujian' model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ujian()
    {
        return $this->belongsTo(ujian::class, 'id_ujian');
    }

    /**
     * Relationship with 'sesi_ujian' model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sesi_ujian()
    {
        return $this->belongsTo(sesi_ujian::class, 'id_sesi_ujian', 'id_sesi_ujian');
    }

    /**
     * Relationship with 'pelajar' model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelajar()
    {
        return $this->belongsTo(pelajar::class, 'id_pelajar');
    }
}
