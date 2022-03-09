@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <h4>Tambah Siswa</h4>
            <hr>
            <form action="{{route('tagihan.post', [$tagihan->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-2">
                    <label for="" class="label-form-col my-2 col-md-3">
                    Jenis Tagihans
                </label>
                <input type="hidden" name="dropdown" id="ddvalue" value="{{$tagihan->tipe_tagihan}}">
                <div class="col-md-9">
                    <select name="tipe_tagihan" id="ddparent" value="" class="form-control">
                        <option value="">Pilih Salah Satu</option>
                        @foreach($tipe as $t)
                        <option value="{{$t->id}}">{{$t->tipe_tagihan}}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" name="nama" id="nama" value="{{$tagihan->name ?? ''}}" placeholder="Nama Lengkap"> --}}
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                Keterangan
            </label>
                <div class="col-md-9">
                    <textarea name="keterangan" class="form-control" id="" cols="20" rows="3">{{$tagihan->keterangan ?? '' }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                Jumlah
            </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{$tagihan->jumlah ?? ''}}" placeholder="Jumlah Tagihan">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                Tipe
            </label>
                <div class="col-md-9">
                    <select name="tipe" id="" class="form-control" value="{{ $tagihan->tipe ?? '' }}">
                        <option value="0">Bulanan</option>
                        <option value="1">1x Bayar</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    NISN
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nisn"  placeholder="NISN" value="{{$tagihan->nisn ?? ''}}">
                </div>
            </div>
            <div class="text-end">
                <a href="{{route('tagihan')}}" class="btn btn-danger text-light">Batal</a>
                <button class="btn btn-info text-light">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(window).on('load', function(){
        $('#ddparent').val('{{$tagihan->tipe_tagihan}}');
    });
</script>
@endsection
