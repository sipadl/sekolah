<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- DataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Sekolah</title>
  </head>
  <body>
    <div class="container">
        @auth
        @if(Auth::user()->roles == 4)
        <nav class="navbar navbar-expand navbar-light bg-light d-flex justify-content-center">
            <div class="nav navbar-nav ">
                <a class="nav-item nav-link {{ Request::segment(2) == null ?'active' : ''}}" href="{{route('user')}}">Dasboard</a>
                <a class="nav-item nav-link {{ Request::segment(2) == 'admin' ?'active' : ''}}" href="{{route('admin')}}">Admin</a>
                <a class="nav-item nav-link {{ Request::segment(2) == 'siswa' ?'active' : ''}}" href="{{route('siswa')}}">Siswa</a>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::segment(2) == 'tagihan' ?'active' : ''}}" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Tagihan
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="{{route('tagihan')}}">Jenis Tagihan</a></li>
                          <li><a class="dropdown-item" href="{{route('tagihan.history')}}">Riwayat Tagihan</a></li>
                          <li><a class="dropdown-item" href="{{route('tagihan.topup')}}">Top up Siswa</a></li>
                          <li><a class="dropdown-item" href="{{route('saldolist') }}">Saldo</a></li>
                          <li><a class="dropdown-item" href="{{ route('tagihan.waiting') }}">Waiting List</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::segment(2) == 'profile' ?'active' : ''}}" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="{{route('me') }}">Pengaturan</a></li>
                          <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
            </div>
        </nav>
        @endif
        @if(Auth::user()->roles == 3)
        <nav class="navbar navbar-expand navbar-light bg-light d-flex justify-content-center">
            <div class="nav navbar-nav ">
                <a class="nav-item nav-link {{ Request::segment(2) == null ?'active' : ''}}" href="{{route('user')}}">Dasboard</a>
                {{-- <a class="nav-item nav-link {{ Request::segment(2) == 'admin' ?'active' : ''}}" href="{{route('admin')}}">Admin</a> --}}
                {{-- <a class="nav-item nav-link {{ Request::segment(2) == 'siswa' ?'active' : ''}}" href="{{route('siswa')}}">Siswa</a> --}}
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::segment(2) == 'tagihan' ?'active' : ''}}" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Tagihan
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          {{-- <li><a class="dropdown-item" href="{{route('tagihan')}}">Jenis Tagihan</a></li> --}}
                          <li><a class="dropdown-item" href="{{route('tagihan.history')}}">Riwayat Tagihan</a></li>
                          {{-- <li><a class="dropdown-item" href="{{route('tagihan.topup')}}">Top up Siswa</a></li> --}}
                          <li><a class="dropdown-item" href="{{route('saldolist') }}">Saldo Siswa</a></li>
                          {{-- <li><a class="dropdown-item" href="{{ route('tagihan.waiting') }}">Waiting List</a></li> --}}
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::segment(2) == 'profile' ?'active' : ''}}" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="{{route('me') }}">Pengaturan</a></li>
                          <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
            </div>
        </nav>
        @endif
        @if(Auth::user()->roles == 0)
        <nav class="navbar navbar-expand navbar-light bg-light d-flex justify-content-center">
            <div class="nav navbar-nav ">
                <a class="nav-item nav-link {{ Request::segment(2) == null ?'active' : ''}}" href="{{route('user')}}">Dasboard</a>
                <a class="nav-item nav-link {{ Request::segment(2) == 'tagihan' ?'active' : ''}}" href="{{route('tagihan.user')}}">Tagihan</a>
                <a class="nav-item nav-link {{ Request::segment(2) == 'topup' ?'active' : ''}}" href="{{route('topup.user')}}">Top Up</a>
                <a class="nav-item nav-link {{ Request::segment(2) == 'history' ?'active' : ''}}" href="{{route('history.user')}}">Riwayat</a>
                  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::segment(2) == 'profile' ?'active' : ''}}" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="{{route('me') }}">Informasi Pribadi</a></li>
                          {{-- <li><a class="dropdown-item" href="{{route('pengaturan') }}">Pengaturan</a></li> --}}
                          <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
            </div>
        </nav>
        @endif
        @endauth
        <div class="p-3">
            @if(Session::has('msg'))
            <div class="alert alert-info" role="alert">
                <strong>{{ Session::get('msg') }}</strong>
            </div>
            @endif

