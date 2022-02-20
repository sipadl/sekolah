<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'username' => $row[1],
            'nama lengkap' => $row[2],
            'nisn' => $row[3],
            'email' => $row[4],
            'telp' => $row[5],
            'tempat_lahir' => $row[11],
            'tanggal_lahir' => $row[12],
            'tanggal_daftar' => $row[18]
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }
}
