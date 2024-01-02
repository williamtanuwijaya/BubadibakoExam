<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelajar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pelajar';
       /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_kelas',
        'nisn',
        'nama',
        'kata_sandi',
        'jenis_kelamin'
    ];

        /**
     * kelas
     *
     * @return void
     */
    // Model pelajar.php
    public function classrooms()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }
}
