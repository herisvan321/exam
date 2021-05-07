<?php

namespace App\Imports;

use App\Jawaban;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JawabanImportAll implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Jawaban([
            'bsoal_id' => $row['bsoal_id'],
            'objectif' => strtoupper($row['objectif']),
            'content'  => $row['content']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
