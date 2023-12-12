<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    use HasFactory;

     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_mapel',
    ];

     /**
     * mata_pelajaran
     *
     * @return void
     */
    public function mata_pelajaran()
    {
        return $this->belongsTo(mata_pelajaran::class);
    }
}
