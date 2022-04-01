<?php

namespace App\Imports;

use App\Models\User;
use Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdminImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $this->main = new Main;
        foreach ($rows as $row)
        {
                if(isset($row['username'])){
                User::create([
                    'name' => $row['fullname'],
                    'username' => $row['username'],
                    'fullname' => $row['fullname'],
                    'kelas' => $row['kelas'],
                    'password' => Hash::make($row['password']),
                    'otp' => mt_rand(100000, 999999),
                    'thumbnail' => '',
                    // 'nisn' => $row['nis'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    // 'tempat_lahir' => $row['tempat_lahir'],
                    // 'tanggal_lahir' => $row['tanggal_lahir'],
                ]);
            }
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
