<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pertanyaan';

    protected $fillable = [
        'id_ujian',
        'pertanyaan',
        'pilihan_1',
        'pilihan_2',
        'pilihan_3',
        'pilihan_4',
        'pilihan_5',
        'jawaban',
    ];

    public function ujian()
{
    return $this->belongsTo(ujian::class, 'id_pertanyaan', 'id_ujian');
}
}
