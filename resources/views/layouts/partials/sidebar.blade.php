<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <!-- Profile -->
        <li class="nav-item nav-profile">
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold">{{ auth()->user()->nama }}</span>
                </div>
            </a>
        </li>

        {{-- ========================================
        MENU UNTUK BENDAHARA
        ========================================= --}}
        @if(auth()->user()->role === 'bendahara')
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/stok">
                    <span class="menu-title">Stok ATK</span>
                    <i class="mdi mdi-warehouse menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/permintaan">
                    <span class="menu-title">Permintaan ATK</span>
                    <i class="mdi mdi-clipboard-text menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#persediaan" aria-expanded="false"
                    aria-controls="persediaan">
                    <span class="menu-title">Manajemen Persediaan</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-warehouse menu-icon"></i>
                </a>
                <div class="collapse" id="persediaan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/pemasukan">Pemasukan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pengeluaran">Pengeluaran</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#atk" aria-expanded="false" aria-controls="atk">
                    <span class="menu-title">Manajemen ATK</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-package-variant menu-icon"></i>
                </a>
                <div class="collapse" id="atk">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/satuan">Satuan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/kategori">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="/atk">Atk</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-package-variant menu-icon"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/laporan">Laporan Bulanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('laporan.rincian') }}">Laporan
                                Persediaan</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pengguna" aria-expanded="false"
                    aria-controls="pengguna">
                    <span class="menu-title">Manajemen Pengguna</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                </a>
                <div class="collapse" id="pengguna">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/pengguna">Pengguna</a></li>
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    </ul>
                </div>
            </li>
        @endif

        {{-- ========================================
        MENU UNTUK USER BIASA
        ========================================= --}}
        @if(auth()->user()->role === 'user')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.user') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/stok">
                    <span class="menu-title">Stok ATK</span>
                    <i class="mdi mdi-warehouse menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/permintaan">
                    <span class="menu-title">Permintaan</span>
                    <i class="mdi mdi-cart-arrow-down menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/riwayat">
                    <span class="menu-title">Riwayat</span>
                    <i class="mdi mdi-history menu-icon"></i>
                </a>
            </li>
        @endif

    </ul>
</nav>