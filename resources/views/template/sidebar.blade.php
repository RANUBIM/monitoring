    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="index.html">Stisla</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="index.html">St</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                        <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                    </ul>
                </li>

                <li class="menu-header">Master Data</li>
                {{-- <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                        <span>Auth</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-reset-password.html">Reset Password</a></li>
                    </ul>
                </li> --}}
                @if (Auth::user()->role === 'Kepala Jurusan')
                    <li><a class="nav-link" href="{{ url('/user') }}"><i class="fas fa-user"></i><span>User</span></a>
                    </li>
                    <li><a class="nav-link" href="{{ url('/labor') }}"><i class="fas fa-home"></i><span>Labor</span></a>
                    </li>
                    <li><a class="nav-link" href="{{ url('/alat') }}"><i class="fa fa-screwdriver"></i><span>Alat</span></a>
                    </li>
                    <li><a class="nav-link" href="{{ url('/bahan') }}"><i class="fas fa-briefcase"></i><span>Bahan</span></a>
                    </li>
                @elseif (Auth::user()->role === 'Guru' || Auth::user()->role === 'Siswa')
                    <li><a class="nav-link" href="{{ url('/alat') }}"><i class="fa fa-screwdriver"></i><span>Alat</span></a>
                    </li>
                    <li><a class="nav-link" href="{{ url('/bahan') }}"><i class="fas fa-briefcase"></i><span>Bahan</span></a>
                    </li>
                @endif




                <li class="menu-header">MAIN DATA</li>
                <li><a class="nav-link" href="{{ url('/peminjaman') }}"><i
                            class="fas fa-cube"></i><span>Peminjaman</span></a>
                </li>
                <li><a class="nav-link" href="{{ url('/penggunaan') }}"><i
                            class="fas fa-cube"></i><span>Penggunaan</span></a>
                </li>


                {{-- <div class="simpanan">
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                            <span>Auth</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                            <li><a href="auth-login.html">Login</a></li>
                            <li><a href="auth-register.html">Register</a></li>
                            <li><a href="auth-reset-password.html">Reset Password</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                            <span>Peminjaman Alat</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="auth-forgot-password.html">Peminjaman</a></li>
                            <li><a href="auth-login.html">Pengembalian</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                            <span>Penggunaan Bahan</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="auth-forgot-password.html">Pengajuan</a></li>
                            <li><a href="auth-login.html">Penggunaan</a></li>
                        </ul>
                    </li>
                </div> --}}
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                </a>
            </div>
        </aside>
    </div>
