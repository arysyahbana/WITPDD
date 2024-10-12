<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('dist/img/logo.webp') }}" alt="" width="50px" class="img-fluid py-2">
        </div>
        <div class="sidebar-brand-text mx-3">WITPDD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $page == 'Dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item {{ $page == 'Pendapatan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pendapatan.index') }}">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Pendapatan Desa</span>
        </a>
    </li>

    {{-- <li class="nav-item {{ $page == 'Bidang' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bidang.index') }}">
            <i class="fas fa-fw fa-th-list"></i>
            <span>Bidang</span>
        </a>
    </li> --}}

    <li class="nav-item {{ $page == 'Anggaran' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('anggaran.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Anggaran Dana</span>
        </a>
    </li>

    <li class="nav-item {{ $page == 'Pembelanjaan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembelanjaan.index') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Pembelanjaan</span>
        </a>
    </li>

    <li class="nav-item {{ $page == 'Laporan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.index') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan Keuangan</span>
        </a>
    </li>

    <li class="nav-item {{ $page == 'Krisar' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('krisar.index') }}">
            <i class="fas fa-fw fa-comments"></i>
            <span>Kritik dan Saran</span>
        </a>
    </li>

    <li class="nav-item {{ $page == 'Operator' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Operator</span>
        </a>
    </li>

    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
