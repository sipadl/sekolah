@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <h4>Riwayat Transaksi Siswa</h4>
        {{-- <a href="{{route('tagihan.add') }}" class="btn btn-info btn-block text-light">Tambah Tagihan</a> --}}
    </div>
    <div class="">
    </div>
</div>
<div class="card p-2">
    <table class="table" id="id_table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $i = 1;
            @endphp
            @foreach($tagihan as $ad)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$ad->nisn}}</td>
                <td>{{$ad->fullname}}</td>
                <td>{{$ad->kelas}}</td>
                <td>{{number_format($ad->debit,0)}}</td>
                <td>{{number_format($ad->credit,0)}}</td>
                <td>{{date('d/m/Y' ,strtotime($ad->tanggal))}}</td>
                <td>{{$ad->keterangan ?? 'Top Up Saldo'}}</td>
                <td>{{$ad->tipe}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('script')
<script>
$(document).ready(function() {
    $('#id_table').DataTable( {
        // Option was here
    } );
} );
</script>
@endsection
@endsection
