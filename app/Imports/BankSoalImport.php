<?php

namespace App\Imports;

use App\BankSoal;
use App\Jawaban;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BankSoalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $type_soal;
    protected $jenis;
    protected $tingkat_id;
    protected $matpel_id;

    public function __construct($type_soal, $jenis, $matpel_id, $tingkat_id)
    {
        $this->type_soal = $type_soal;
        $this->jenis = $jenis;
        $this->tingkat_id = $tingkat_id;
        $this->matpel_id = $matpel_id;
    }
    public function model(array $row)
    {
        return new BankSoal([
            'tingkat_id'  => $this->tingkat_id,
            'matpel_id'   => $this->matpel_id,
            'type_soal'   => $this->type_soal,
            'jenis_soal'  => $this->jenis,
            'lable'       => $row['lable'],
            'soal'        => $row['soal'],
            'keterangan'  => $row['keterangan'],
            'jawaban'     => strtoupper($row['jawaban']),
            'jlm_jawaban' => $row['jlm_jawaban'],
            'skor_soal'   => $row['skor_soal']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
