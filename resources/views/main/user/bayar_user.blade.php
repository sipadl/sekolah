@extends('main.layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-6 card p-4">
        <h4 class="">Detail Pembayaran Siswa</h4>
        <br>
        <form action="{{ route('bayar.user.post', [$tagihan->id]) }}" method="POST">
            @csrf
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-4 my-2">Nama Lengkap</label>
            <div class="col-8">
                <input type="text" readonly value="{{$tagihan->fullname}}" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">NIS</label>
            <div class="col-8">
                <input type="text" readonly value="{{$tagihan->nisn}}" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Tipe Pembayaran</label>
            <div class="col-8">
                <input type="text" readonly value="{{$tagihan->tipe_tagihan}}" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Keterangan</label>
            <div class="col-8">
                <input type="text" readonly value="{{$tagihan->keterangan}}" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Jumlah</label>
            <div class="col-8">
                <input type="text" readonly value="{{number_format($tagihan->jumlah,0)}}" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-4 my-2">Status</label>
            <div class="col-8">
                <input type="text" readonly value="{{($tagihan->status == 1 )?'Sudah Bayar':'Belum Bayar'}}" class="form-control">
            </div>
        </div>
        <div class="text-center">
            @if($tagihan->status != 1)
            <button class="btn btn-primary" type="submit">Bayar Langsung</button>
            <a href="#" class="btn btn-danger">Bayar Dengan Cicil</a>
            @else
            <button class="btn btn-secondary" disabled>Sudah Dibayar</button>
            @endif
        </div>
    </form>
    </div>
</div>

@stop
