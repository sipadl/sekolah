@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <a href="{{route('siswa.add') }}" class="btn btn-info btn-block text-light">Tambah Siswa</a>
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
                <th>Nama</th>
                <th>Kelas</th>
                <th>NIS</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $i = 1;
                @endphp
            @foreach($user as $ad)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$ad->name}}</td>
                <td>{{$ad->kelas}}</td>
                <td>{{$ad->nisn}}</td>
                <td>{{$ad->tempat_lahir}}</td>
                <td>{{$ad->tanggal_lahir}}</td>
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
