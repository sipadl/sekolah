@extends('main.layouts.main')
@section('content')
<div class="d-flex justify-content-between my-2">
    <div class="">
        <a href="{{route('admin.add') }}" class="btn btn-info btn-block text-light">Tambah Admin</a>
    </div>
    <div class="">
        <a href="{{route('fileImportExport') }} " class="btn btn-danger btn-block text-light">Export</a>
        <a href="{{route('file-export') }}" class="btn btn-warning btn-block text-light">Import</a>
    </div>
</div>
<div class="card p-2">
    <table class="table" id="id_table">
        <thead class="text-center">
            <tr>
                <th>No</th>
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
                <td>{{$ad->username}}</td>
                <td>{{($ad->roles != 4)?'Super Admin':'Administrator' }}</td>
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
