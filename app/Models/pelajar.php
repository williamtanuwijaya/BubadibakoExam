<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelajar extends Model
{
    use HasFactory;

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
    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }
}
