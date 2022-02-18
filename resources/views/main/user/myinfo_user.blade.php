@extends('main.layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-6 card p-4">
        <div class="d-flex justify-content-between">
            <h4 class="">Informasi Pribadi</h4>
            <a href="{{ route('user') }}" class="btn btn-info text-light">Kembali</a>
        </div>
        <br>
            @csrf
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">Nama Lengkap</label>
                <div class="col-8">
                    <input type="text" readonly value="{{$data->fullname}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">NIS</label>
                <div class="col-8">
                    <input type="text" readonly value="Rp {{$data->nisn}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">Saldo</label>
                <div class="col-8">
                    <input type="text" readonly value="Rp {{number_format($data->saldo)}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">No Rekening</label>
                <div class="col-8">
                    <input type="text" readonly value="{{$data->account_number}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">Cif Number</label>
                <div class="col-8">
                    <input type="text" readonly value="{{$data->cif_number}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">Email</label>
                <div class="col-8">
                    <input type="text" readonly value="{{$data->email}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">No. Handphone</label>
                <div class="col-8">
                    <input type="text" readonly value="{{$data->telp ?? 'Belum Menambahkan No. Handphone'}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">Tanggal Daftar</label>
                <div class="col-8">
                    <input type="text" readonly value="{{$data->created_at ?? date('d/m/Y')}}" class="form-control">
                </div>
            </div>
    </div>
</div>

@stop
