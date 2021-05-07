<?php

namespace App\Imports;

use App\Jawaban;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JawabanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $data_id;

    public function __construct($data_id)
    {
        $this->data_id = $data_id;
    }
    public function model(array $row)
    {
        return new Jawaban([
            'bsoal_id' => $this->data_id,
            'objectif' => strtoupper($row['objectif']),
            'content'  => $row['content']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
