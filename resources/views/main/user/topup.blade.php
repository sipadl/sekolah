@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <h4>Tambah Saldo Siswa</h4>
            <hr>
            <form action="{{route('topup.post')}}" method="POST">
                @csrf
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col my-2 col-md-3">
                    NISN
                </label>
                <div class="col-md-9">
                    <select name="user_id" class="form-control select2" id="">
                        @foreach($user as $s)
                        <option value="{{$s->id}}">{{$s->nisn .' | '. $s->fullname}}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" name="nisn" id="nisn" placeholder="nisn"> --}}
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Nominal
                </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" name="nominal"  placeholder="Nominal">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="" class="label-form-col my-2 col-md-3">
                    Keterangan
                </label>
                <div class="col-md-9">
                    <textarea name="keterangan" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="text-center">
                <a href="{{route('tagihan')}}" class="btn btn-danger text-light">Batal</a>
                <button class="btn btn-info text-light">Top Up</button>
            </div>
        </form>
        </div>
    </div>
</div>
@section('script')
<script>
$(document).ready(function() {
$('.select2').select2();
});
</script>
@endsection
@endsection
