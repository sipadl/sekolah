@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-8">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://placeimg.com/640/400/nature" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://placeimg.com/640/400/nature" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://placeimg.com/640/400/nature" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    <div class="col-4">
        <iframe src="https://calendar.google.com/calendar/embed?src=5rqouvhspac1962sa6dfvqkcso%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="500px" height="500px" frameborder="0" scrolling="no"></iframe>

    </div>
</div>

@endsection
