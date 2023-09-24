@include('layouts.head');

<div class="wrapper">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{asset('img/profile.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    @if (\App\Models\Auth::user())
                    <a href="#" class="d-block">{{\App\Models\Auth::user()->nama_guru}}</a>
                    @endif
                    @if (\App\Models\Auth::user() && \App\Models\Auth::user()->wali_kelas &&
                    \App\Models\Auth::user()->wali_kelas != 'admin')
                    <a href="#" class="d-block">Wali Kelas {{\App\Models\Auth::user()->wali_kelas}}</a>
                    @elseif(\App\Models\Auth::user() && \App\Models\Auth::user()->wali_kelas == 'admin')
                    <a href="#" class="d-block">Admin</a>
                    @else
                    <a href="#" class="d-block">Guru</a>
                    @endif
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" style="width: 100px !important;">
                <ul class="nav nav-pills  nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                    @if (\App\Models\Auth::user() && \App\Models\Auth::user()->wali_kelas != 'admin')
                    <li class="nav-item">
                        <a href="{{route('index')}}" class="nav-link {{request()->is('/') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Semua Laporan
                            </p>
                        </a>
                    </li>
                    @endif

                    @if (\App\Models\Auth::user() && (!\App\Models\Auth::user()->wali_kelas ||
                    \App\Models\Auth::user()->wali_kelas))
                    <li class="nav-item">
                        <a href="{{route('siswa.index')}}" class="nav-link {{request()->is('siswa') ? 'active' : ''}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <p>
                                Siswa
                            </p>
                        </a>
                    </li>
                    @endif

                    @if (\App\Models\Auth::user() && \App\Models\Auth::user()->wali_kelas == 'admin')
                    <li class="nav-item">
                        <a href="{{route('guru.index')}}" class="nav-link {{request()->is('guru') ? 'active' : ''}}">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                            <p>
                                Guru
                            </p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item " style="margin-top: 500px !important;">
                        <a href="{{route('logout')}}" class="nav-link ">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                @yield('header')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @yield('content')
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>

@include('layouts.script');
