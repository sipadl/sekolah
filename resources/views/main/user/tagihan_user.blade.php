@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <h4>Tagihan Siswa</h4>
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
                <th>Username</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tagihan</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Action</th>
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
                <td>{{$ad->username ?? ''}}</td>
                <td>{{$ad->fullname}}</td>
                <td>{{$ad->kelas}}</td>
                <td>{{$ad->tipe_tagihan}}</td>
                <td>{{date('d/m/Y' ,strtotime($ad->created_at))}}</td>
                <td>{{number_format($ad->jumlah,0)}}</td>
                <td>{{($ad->status == 1)?'Sudah Bayar':'Belum Bayar'}}</td>
                <td>
                    <span>
                        <a href="{{route('bayar.user', [$ad->id]) }}" class="btn btn-warning btn-sm">Bayar</a>
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
