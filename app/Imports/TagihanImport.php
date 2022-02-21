<?php

namespace App\Imports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class TagihanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tagihan([
            'tipe_tagihan' => $row['tipe_tagihan'],
            'keterangan' => $row['keterangan'],
            'tipe' => $row['cicilan'],
            'nisn' => $row['nis'],
            'jumlah' => $row['jumlah'],
            'created_at' => Carbon::now(),
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
