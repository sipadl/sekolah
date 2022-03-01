@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <h4>Tambah Admin / Accuntant</h4>
            <hr>
            <form action="{{route('admin.add.post')}}" method="POST">
                @csrf
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col my-2 col-md-3">
                    Username
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="username" id="username" value="{{$admin->username ?? ''}}" placeholder="Username">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Password
                </label>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="password"  placeholder="Password" value="{{$admin->password ?? ''}}">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Role
                </label>
                <div class="col-md-9">
                    <select name="role" id="" class="form-control">
                        <option value="4">Admin</option>
                        <option value="3">Akuntan</option>
                    </select>
                </div>
            </div>
            <div class="text-end">
                <a href="{{route('admin')}}" class="btn btn-danger text-light">Batal</a>
                <button class="btn btn-info text-light">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
