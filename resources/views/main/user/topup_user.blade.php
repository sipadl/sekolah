@extends('main.layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-6 card p-4">
        <h4 class="">Top Up Saldo</h4>
        <br>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Nama Lengkap</label>
            <div class="col-8">
                <input type="text" readonly value="{{$user->fullname}}" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Metode Pembayaran</label>
            <div class="col-8">
                <select name="bank" id="" class="form-control">
                    <option value="0">TU Sekolah</option>
                    <option value="1">Koperasi</option>
                </select>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Jumlah Top Up</label>
            <div class="col-8">
                <input type="number" name="nominal" class="form-control">
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-primary">Top Up</button>
        </div>
    </div>
</div>

@stop
