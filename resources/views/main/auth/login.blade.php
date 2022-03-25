@extends('main.layouts.main')
@section('content')
<div class="d-flex row justify-content-center">
    <div class="card p-4 col-5">
        <div class="text-center">
            <img class="w-25" src="{{ asset('/images/LogoSekolah.png') }}" alt="">
        </div>
        <form action="{{route('logins')}}" method="POST">
        @csrf
            <div class="form-group row mb-2">
            <label for="" class="label-form-col col-3">Username</label>
            <div class="col-9">
                <input type="text" name="username" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-3">Password</label>
            <div class="col-9">
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="text-center mt-4">
            <a  href="{{ route('register') }}" class="btn btn-block btn-light">Daftar</a>
            <button class="btn btn-block btn-info text-light">Login</button>
        </div>
        </form>
    </div>
</div>
@endsection
