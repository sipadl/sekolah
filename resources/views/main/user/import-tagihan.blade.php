@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('fileImportTagihan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">File Excel Tagihan User</label>
        <input type="file" name="file" class="form-control">
        <button type="submit" class="btn btn-info text-light mt-3">Upload</button>
        <a href={{ url(@asset('/file/default_template_tagihan.xlsx')) }} class="btn btn-info text-light mt-3">Download Template</a>
        </form>
    </div>
</div>
@stop
