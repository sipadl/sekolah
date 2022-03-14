<?php

namespace App\Imports;

use App\Models\User;
use App\Classes\Main;
use Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements WithHeadingRow,ToModel
{
    public function __construct() {
        $this->main = new Main();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $this->main = new Main();
        return User::create([
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
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
        ]);
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
    }

    // public function collection(Collection $rows)
    // {
    //         foreach ($rows as $row) {
    //         dd($row);
    //         User::create([
    //             'name' => $row['name'],
    //             'username' => $row['username'],
    //             'fullname' => $row['fullname'],
    //             'kelas' => $row['kelas'],
    //             'password' => Hash::make($row['password']),
    //             'otp' => mt_rand(100000, 999999),
    //             'thumbnail' => '',
    //             'nisn' => $row['nis'],
    //             'email' => $row['email'],
    //             'telp' => $row['telp'],
    //             'tempat_lahir' => $row['tempat_lahir'],
    //             'tanggal_lahir' => $row['tanggal_lahir'],
    //         ]);
    //         // $data = [
    //         //     'fullname' => $row['fullname'],
    //         //     'email' => $row['email'],
    //         //     'telp' => $row['telp'],
    //         //     'nisn' => $row['nis'],
    //         //     'tempat_lahir' => $row['tempat_lahir'],
    //         //     'tanggal_lahir' => $row['tanggal_lahir'],
    //         // ];
    //         // $this->main->createMandatory($data);
    //     }

    // }

    public function headingRow(): int
    {
        return 1;
    }
}
