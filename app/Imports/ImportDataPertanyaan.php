<?php

namespace App\Imports;

use App\Models\pertanyaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDataPertanyaan implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pertanyaan([
            'id_ujian'   => (int) $row['id_ujian'],
            'pertanyaan'  => $row['pertanyaan'],
            'pilihan_1'  => $row['pilihan_1'],
            'pilihan_2'  => $row['pilihan_2'],
            'pilihan_3'  => $row['pilihan_3'],
            'pilihan_4'  => $row['pilihan_4'],
            'pilihan_5'  => $row['pilihan_5'],
            'jawaban'    => $row['jawaban'],
        ]);
    }
}
