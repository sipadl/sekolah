<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class RiwayatTagihan implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $data = DB::select("select
        u.id, u.nisn, u.name, u.fullname, u.kelas, keterangan,
        tt.tipe_tagihan as tagihan,t.jumlah,t.tipe, tu.order_number from tagihan_user tu
        left join users u on u.id = tu.user_id
        left join tagihans t on tu.tagihan_id = t.id
        left join tipe_tagihan tt on t.tipe_tagihan = tt.id ");
        return collect($data);
    }

    public function headings(): array
    {
        return ["id","nisn","fullname","kelas","nis","keterangan","tagihan","jumlah","tipe","order_number"];
    }
}
