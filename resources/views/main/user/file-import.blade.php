@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">File Excel</label>
        <input type="file" name="file" class="form-control">
        <button type="submit" class="btn btn-info text-light mt-3">Upload</button>
        </form>
    </div>
</div>
@stop
