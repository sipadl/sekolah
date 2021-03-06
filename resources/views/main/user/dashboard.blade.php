@extends('main.layouts.main')
@section('content')
<div class="row">
    <div class="col-8">
        <div class="d-flex text-center row">
            <div class="col-6">
                <h4>Visi</h4> <br>
                <p>
                    Unggul dalam prestasi, berkarakter, berbudaya, peduli lingkungan, berwawasan global yang dilandasi iman dan takwa
                </p>
            </div>
            <div class="col-6">
                <h4>Misi</h4> <br>
                <p>
                    Membina peserta didik unggul dalam prestasi akademis dan non-akademis di taraf nasional maupun internasional. Membina peserta didik unggul dalam perolehan nilai ujian sekolah dan ujian nasional serta berhasil masuk perguruan tinggi di dalam maupun luar negeri.
                </div>

        </div>
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
        <div class="row  d-flex my-2 justify-content-between">
            @if($user->roles == 4 )
            <div class="card text-white bg-info mx-2 col-10 ">
                <div class="card-body">
                    <h6 class="card-title">Rp {{number_format($user->saldo,0)}}</h6>
                    <p class="card-text">Total Saldo</p>
                </div>
            </div>
            @endif
            @if($user->roles == 0 )
                <div class="card text-white bg-info mx-2 col-5 ">
                    <div class="card-body">
                        <h6 class="card-title">Rp {{number_format($user->saldo,0)}}</h6>
                        <p class="card-text">Total Saldo</p>
                    </div>
                </div>
                <div class="card text-white bg-danger mx-2 col-5 ">
                    <div class="card-body">
                        <h6 class="card-title">Rp {{number_format($tagihan[0]->total,0)}}</h6>
                        <p class="card-text">Total Tagihan</p>
                    </div>
                </div>
                @endif
            </div>
        <iframe src="https://calendar.google.com/calendar/embed?src=5rqouvhspac1962sa6dfvqkcso%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="500px" height="500px" frameborder="0" scrolling="no"></iframe>

    </div>
</div>

@endsection
