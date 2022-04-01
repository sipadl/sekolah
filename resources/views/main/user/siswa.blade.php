@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <a href="{{route('siswa.add') }}" class="btn btn-info btn-block text-light">Tambah Siswa</a>
    </div>
    <div class="">
        <a href="{{route('fileImportExport') }} " class="btn btn-danger btn-block text-light">Import</a>
        <a href="{{route('file-export') }}" class="btn btn-warning btn-block text-light">Export</a>
    </div>
</div>
<div class="card p-2">
    <table class="table" id="id_table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
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
                <td>{{$ad->fullname}}</td>
                <td>{{$ad->username}}</td>
                <td>{{$ad->kelas}}</td>
                <td>{{$ad->nisn}}</td>
                <td>{{$ad->tempat_lahir}}</td>
                <td>{{$ad->tanggal_lahir}}</td>
                <td>
                    <span>
                        <a href="javascript;:" class="btn btn-danger btn-sm" data-bs-toggle="modal" onclick="get({{$ad->id}})" data-bs-target="#hapus">
                            Hapus
                          </a>
                        {{-- <a href="{{route('siswa.delete',$ad->id)}}" class="btn btn-danger btn-sm">Hapus</a> --}}
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
<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Akan Menhapus Data Ini  ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer" id="submit">
          {{-- <a href="{{route('logout')}}" class="btn btn-danger">Ya, Saya Yakin</a> --}}
        </div>
      </div>
    </div>
  </div>
@section('script')
<script>
function get(id) {
    $('#submit').html('')
    $('#submit').append('<a href="/user/siswa/hapus/'+id+'" class="btn btn-danger">Ya, Saya Yakin</a>');
    $('#submit').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>');
}

$(document).ready(function() {
    $('#id_table').DataTable( {
        // Option was here
    } );
} );
</script>
@endsection
@endsection
