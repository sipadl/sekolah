<?php

namespace App\Imports;

use App\Models\Siswa as User;
use Hash;
use Maatwebsite\Excel\Concerns\ToModel;
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
        // $x = new User([
        //     'name' => $row['fullname'],
        //     'username' => $row['username'],
        //     'fullname' => $row['fullname'],
        //     'kelas' => $row['kelas'],
        //     'password' => Hash::make($row['password']),
        //     'otp' => mt_rand(100000, 999999),
        //     'thumbnail' => '',
        //     'nisn' => $row['nis'],
        //     'email' => $row['email'],
        //     'telp' => $row['telp'],
        //     'tempat_lahir' => $row['tempat_lahir'],
        //     'tanggal_lahir' => $row['tanggal_lahir'],
        //     // 'tanggal_daftar' => $row['tanggal_daftar'],
        // ]);
        // $data = [
        //     'fullname' => $row['fullname'],
        //     'email' => $row['email'],
        //     'telp' => $row['telp'],
        //     'nisn' => $row['nis'],
        //     'tempat_lahir' => $row['tempat_lahir'],
        //     'tanggal_lahir' => $row['tanggal_lahir'],
        // ];
        // $this->main->createMandatory($data);
        // return $x;
        // return new User([
        //     'name' => $row['fullname'],
        //     'username' => $row['username'],
        //     'fullname' => $row['fullname'],
        //     'kelas' => $row['kelas'],
        //     'password' => Hash::make($row['password']),
        //     'otp' => mt_rand(100000, 999999),
        //     'thumbnail' => '',
        //     'nisn' => $row['nis'],
        //     'email' => $row['email'],
        //     'telp' => $row['telp'],
        //     'tempat_lahir' => $row['tempat_lahir'],
        //     'tanggal_lahir' => $row['tanggal_lahir'],
        // ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
