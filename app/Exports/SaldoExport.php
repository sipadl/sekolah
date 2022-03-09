<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;



class SaldoExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()

    public function query()
    {

        return User::query()->select('username','fullname','kelas','saldo')->where('roles', 0);
    }

    public function headings(): array
    {
        return ['username','fullname','kelas','saldo'];
    }
}
