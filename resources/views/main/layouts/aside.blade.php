<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Sekolah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url(Auth::user()->thumbnail) ?? asset('dist/img/user2-160x160.jpg')}} " class="img-circle elevation-2" width="40" height="40" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item  {{ Request::segment(1) == 'user'  && Request::segment(2) == null ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Request::segment(1) == 'user'  && Request::segment(2) == null ?'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('user')}}" class="nav-link {{ Request::segment(1) == 'user' && Request::segment(2) == null ?'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin')}}" class="nav-link {{ Request::segment(2) == 'admin' ?'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('siswa')}}" class="nav-link {{ Request::segment(2) == 'siswa' ?'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <hr>
            </ul>
          <li class="nav-item {{ Request::segment(2) == 'tagihan' ?'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Request::segment(2) == 'tagihan' ?'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Tagihan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('tagihan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Tagihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tagihan.history')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Tagihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tagihan.topup')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Up Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('saldolist')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Saldo Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tagihan.waiting')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waiting List</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Guru
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan & Gaji</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenjang</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <hr>
          <li class="nav-item {{ Request::segment(2) == 'profile' ?'active' : ''}}">
            <a href="{{route('me')}}" class="nav-link">
              <i class="far fa-user nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#logout" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @yield('content')
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
