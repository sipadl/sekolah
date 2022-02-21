<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;



class AdminExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()

    public function query()
    {

        return User::query()->select('id','name','username','fullname','kelas','gender','nisn','telp','email','tempat_lahir','tanggal_lahir','created_at')->where('roles', 4);
    }

    public function headings(): array
    {
        return ["id","name","username", "fullname","gender","kelas","nis","telp","email","tempat_lahir","tanggal_lahir","tanggal_daftar"];
    }
}
