@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <a href="{{route('tagihan.add') }}" class="btn btn-info btn-block text-light">Tambah Tagihan</a>
    </div>
    <div class="">
        <a href="#" class="btn btn-danger btn-block text-light">Export</a>
        <a href="#" class="btn btn-warning btn-block text-light">Import</a>
    </div>
</div>
<div class="card p-2">
    <table class="table" id="id_table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Tagihan</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Tipe</th>
                <th>NIS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $i = 1;
            @endphp
            @foreach($tagihan as $ad)
            @php
                $tipe = DB::table('tipe_tagihan')->where('id', $ad->tipe_tagihan)->first();
            @endphp
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$tipe->tipe_tagihan}}</td>
                <td>{{$ad->keterangan}}</td>
                <td>{{$ad->jumlah}}</td>
                <td>{{($ad->tipe == 1)?'1x Bayar':'Cicilan'}}</td>
                <td>{{$ad->nisn}}</td>
                <td>
                    <span>
                        <a href="{{route('siswa.delete',$ad->id)}}" class="btn btn-danger btn-sm">Hapus</a>
                    </span>
                    <span>
                        <a href="{{route('siswa.edit',$ad->id)}}" class="btn btn-warning btn-sm">Ubah</a>
                    </span>
                </td>
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
