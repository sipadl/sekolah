<?php

namespace App\Exports;
use DB;
use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class RiwayatTagihan implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Tagihan::query()
        ->select('tagihans.id','users.nisn','users.fullname','users.kelas','tipe_tagihan.tipe_tagihan','jumlah','keterangan','tagihans.tipe','transactions.created_at')
        ->leftJoin('transactions', 'transactions.tagihan_id', '=', 'tagihans.id')
        ->leftJoin('users', 'users.nisn', '=', 'tagihans.nisn')
        ->leftJoin('tipe_tagihan', 'tipe_tagihan.id', '=', 'tagihans.tipe_tagihan')
        ->where('tagihans.status', 1)
        ->orderBy('tipe_tagihan.created_at', 'asc');
    }

    public function headings(): array
    {
        return ["id","nis","fullname","kelas","tagihan","jumlah","keterangan","tipe","tanggal"];
    }
}
