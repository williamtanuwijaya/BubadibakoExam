<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kelas';
     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_kelas',
    ];
}
