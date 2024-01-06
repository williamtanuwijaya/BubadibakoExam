<?php

namespace App\Imports;

use App\Models\Question;
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
        return new Question([
            'exam_id'   => (int) $row['exam_id'],
            'question'  => $row['question'],
            'option_1'  => $row['option_1'],
            'option_2'  => $row['option_2'],
            'option_3'  => $row['option_3'],
            'option_4'  => $row['option_4'],
            'option_5'  => $row['option_5'],
            'answer'    => $row['answer'],
        ]);
    }
}
