<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_mapel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_mapel',
    ];

    /**
     * Relationship with itself.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mata_pelajaran()
    {
        return $this->belongsTo(mata_pelajaran::class);
    }
}
