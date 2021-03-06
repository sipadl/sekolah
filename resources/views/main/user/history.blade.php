@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <h4 class="my-2 text-center">Riwayat Tagihan</h4>
    </div>
    <div class="">
        <a href="{{ route('RiwayatExport') }}" class="btn btn-danger btn-block text-light">Export</a>
    </div>
</div>
<div class="card p-2">
    <table class="table" id="id_table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Kode Bayar</th>
                <th>NISN</th>
                <th>Siswa</th>
                <th>Tagihan</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $i = 1;
                @endphp
            @foreach($data as $ad)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{ mt_rand(9999,99999)}}</td>
                <td>{{$ad->nisn}}</td>
                <td>{{$ad->fullname}}</td>
                <td>{{$ad->tipe_tagihan}}</td>
                <td>{{$ad->keterangan}}</td>
                <td>{{'Rp '.number_format($ad->jumlah,0)}}</td>
                {{-- <td>
                    <span>
                        <a href="{{route('admin.delete',$ad->id)}}" class="btn btn-danger btn-sm">Hapus</a>
                    </span>
                    <span>
                        <a href="{{route('admin.edit',$ad->id)}}" class="btn btn-warning btn-sm">Ubah</a>
                    </span>
                </td> --}}
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
