@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <a href="{{route('admin.add') }}" class="btn btn-info btn-block text-light">Tambah Admin</a>
    </div>
    <div class="">
        <a href="{{route('ImportAdmin') }}" class="btn btn-warning btn-block text-light">Import</a>
        <a href="{{route('fileExportAdmin') }} " class="btn btn-danger btn-block text-light">Export</a>
    </div>
</div>
<div class="card p-2">
    <table class="table" id="id_table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $i = 1;
                @endphp
            @foreach($admin as $ad)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td><img class="" width="40px" height="40px" src={{ is_file(asset($ad->thumbnail)) ? url(asset($ad->thumbnail)) : url(asset('/images/default-profile.jpg')) }} alt=".."></td>
                <td>{{$ad->username}}</td>
                <td>{{($ad->roles != 4)?'Akuntan':'Administrator' }}</td>
                <td>
                    <span>
                        <a href="{{route('admin.delete',$ad->id)}}" class="btn btn-danger btn-sm">Hapus</a>
                    </span>
                    <span>
                        <a href="{{route('admin.edit',$ad->id)}}" class="btn btn-warning btn-sm">Ubah</a>
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
