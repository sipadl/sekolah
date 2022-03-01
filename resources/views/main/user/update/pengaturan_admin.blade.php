@extends('main.layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-6 card p-4">
        <div class="message"></div>
        <div class="d-flex justify-content-between">
            <h4 class="">Ubah Info Pribadi</h4>
        </div>
        <br>
        <form action="">
            @csrf
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-3 my-2">Nama Lengkap</label>
                <div class="col-9">
                    <input type="text" value="{{$data->fullname}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-3 my-2">NIS</label>
                <div class="col-9">
                    <input type="text" readonly value="{{$data->nisn}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-3 my-2">Saldo</label>
                <div class="col-9">
                    <input type="text" readonly value="Rp {{number_format($data->saldo)}}" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-3 my-2">Email</label>
                <div class="col-9">
                    <input type="email" name="email" value="{{$data->email}}" class="form-control">
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-3 my-2">No. Telp</label>
                <div class="col-9">
                    <input type="text" name="telp" value="{{$data->telp ?? ''}}" placeholder="Belum Menambahkan No. Telp" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col col-3 my-2">Tanggal Daftar</label>
                <div class="col-9">
                    <input type="text" readonly value="{{$data->created_at ?? date('d/m/Y')}}" class="form-control">
                </div>
            </div>
            <div class="text-end mt-4 {{ $data->verified != 1 ?? 'd-none' }}" id="submit-btn">
                <button type="submit" class="btn btn-info text-light">Simpan</button>
                <a href="{{ route('user') }}" class="btn btn-danger text-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@section('script')
<script>
    function sendOTP()
    {
        $.get("{{route('verifikasi.user') }}", {},
            function (data, textStatus, jqXHR) {
                $('.message').append(`
                <div class="alert alert-success" role="alert">
                    <strong id="msg">Berhasil Mengirim Email</strong>
                </div>`)
            },
        );
    }

    function confirmOTP()
    {
        $.post("{{route('confirm.user')}}", {otp: $('#otp').val()},
            function (data, textStatus, jqXHR) {
                $('.message').html('')
                if(data === 'ok'){
                $('.message').append(`
                <div class="alert alert-success" role="alert">
                    <strong id="msg">Berhasil Verifikasi Akun</strong>
                </div>`)
                $('#submit-btn').removeClass('d-none')
                }else{
                $('.message').append(`
                <div class="alert alert-danger" role="alert">
                    <strong id="msg">Cek Kembali OTP Anda</strong>
                </div>`)
                }
            },
        );
    }
</script>
@endsection
@endsection
