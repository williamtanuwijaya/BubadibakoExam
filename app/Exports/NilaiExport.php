<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * grade
     *
     * @var mixed
     */
    protected $nilai;

    /**
     * __construct
     *
     * @param  mixed $nilai
     * @return void
     */
    public function __construct($nilais) {
        $this->nilais = $nilais;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->nilais;
    }

    public function map($nilais) : array {
        return [
            $nilais->ujian->nama_ujian,
            $nilais->sesi_ujian->sesi_ujian,
            $nilais->pelajar->nama,
            $nilais->ujian->kelas->nama_kelas,
            $nilais->ujian->mata_pelajaran->nama_mapel,
            $nilais->nilai,
        ] ;
    }

    public function headings() : array {
        return [
            'Ujian',
            'Sesi',
            'Nama Siswa',
            'Kelas',
            'Pelajaran',
            'Nilai'
        ] ;
    }
}
