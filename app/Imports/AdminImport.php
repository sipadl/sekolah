<?php

namespace App\Imports;

use App\Models\User;
use Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdminImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'username' => $row['username'],
            'fullname' => $row['fullname'],
            'kelas' => $row['kelas'],
            'password' => Hash::make($row['password']),
            'otp' => mt_rand(100000, 999999),
            'thumbnail' => '',
            'nisn' => $row['nis'],
            'email' => $row['email'],
            'telp' => $row['telp'],
            'roles' => '4',
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            // 'tanggal_daftar' => $row['tanggal_daftar'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
