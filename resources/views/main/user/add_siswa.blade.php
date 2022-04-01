@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <h4>Tambah Siswa</h4>
            <hr>
            <form action="{{route('siswa.add.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Nama Lengkap
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="full_name" id="full_name" value="{{$user->fullname ?? ''}}" placeholder="Nama Lengkap">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Username
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="username" id="nama" value="{{$user->username ?? ''}}" placeholder="Nama Panggilan">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Password
                </label>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="password" id="nama" value="" placeholder="Password">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    No. Handphone
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telp" id="telp" value="{{$user->telp ?? ''}}" placeholder="No. Handphone">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                   Email
                </label>
                <div class="col-md-9">
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email ?? ''}}" placeholder="Email">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                   Jenis Kelamin
                </label>
                <div class="col-md-9">
                    <select name="gender" class="form-control" id="" value="{{$user->gender ?? 0}}">
                        <option value="0">Pilih Salah Satu</option>
                        <option value="1">Pria</option>
                        <option value="2">Wanita</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                Kelas
            </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="kelas" id="kelas" value="{{$user->kelas ?? ''}}" placeholder="Kelas">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                NIS
            </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nisn" id="nisn" value="{{$user->nisn ?? ''}}" placeholder="NIS">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                Tempat Lahir
            </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{$user->tempat_lahir ?? ''}}" placeholder="Tempat Lahir">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                Tanggal Lahir
            </label>
                <div class="col-md-9">
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{$user->tanggal_lahir ?? ''}}" placeholder="Tanggal Lahir">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Foto
                </label>
                <div class="col-md-9">
                    <input type="file" class="form-control" name="thumbnail"  placeholder="thumbnail" value="{{$user->thumbnail ?? ''}}">
                </div>
            </div>
            @if(isset($user))
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Current Foto
                </label>
                <div class="col-md-9">
                    <img class="img-thumbnail w-25" src="{{ url($user->thumbnail ?? '') }}">
                </div>
            </div>
            @endif
            <div class="text-end">
                <a href="{{route('siswa')}}" class="btn btn-danger text-light">Batal</a>
                <button class="btn btn-info text-light">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
