<?php
namespace App\Imports;

use App\Models\Siswa as User;
use Hash;
use App\Classes\Main;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportUser implements withHeadingRow,ToCollection
{
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
                    'gender' => $row['gender'] ?? '',
                    'nisn' => $row['nis'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                ]);

                $data = [
                        'fullname' => $row['fullname'],
                        'email' => $row['email'],
                        'telp' => $row['telp'],
                        'nisn' => $row['nis'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tanggal_lahir' => $row['tanggal_lahir'],
                    ];
                $this->main->createMandatory($data);
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
