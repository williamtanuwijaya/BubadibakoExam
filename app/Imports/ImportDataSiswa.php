<?php

namespace App\Imports;

use App\Models\pelajar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportDataSiswa implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pelajar([
            'nisn'          => (int) $row['nisn'],
            'nama'          => $row['nama'],
            'kata_sandi'      => $row['kata_sandi'],
            'jenis_kelamin'        => $row['jenis_kelamin'],
            'id_kelas'  => (int) $row['id_kelas'],
        ]);
    }

    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nisn' => 'unique:pelajars,nisn',
        ];
    }
}
