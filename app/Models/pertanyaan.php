<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    use HasFactory;

        /**
     * fillable
     *
     * @var array
     */
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

        /**
     * exam
     *
     * @return void
     */
    public function ujian()
    {
        return $this->belongsTo(ujian::class);
    }
}
