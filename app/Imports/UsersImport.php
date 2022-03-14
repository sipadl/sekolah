<?php

namespace App\Imports;

use App\Models\Siswa as User;
use Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements WithHeadingRow,ToModel
{
<<<<<<< HEAD

=======
    public function __construct() {
        $this->main = new Main();
    }
>>>>>>> 7bbc99298ec74e491adcb6f52197451e72c51400
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
<<<<<<< HEAD
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
=======
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
>>>>>>> 7bbc99298ec74e491adcb6f52197451e72c51400
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
<<<<<<< HEAD
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
=======
>>>>>>> 7bbc99298ec74e491adcb6f52197451e72c51400
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
