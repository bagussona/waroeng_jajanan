<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>

        <li class="nav-title">MANAJEMEN USER</li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-user"></i> Pengguna
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('members.index') }}">
                        <i class="nav-icon icon-people"></i> Semua Pengguna
                    </a>
                </li>
            </ul>
            </li>
        <li class="nav-title">MANAJEMEN PRODUK</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="nav-icon icon-tag"></i> Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier.index') }}">
                <i class="nav-icon icon-pie-chart"></i> Supplier
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orderan.index') }}">
                <i class="nav-icon icon-basket-loaded"></i> Orderan
                <span style="margin-left: 15px;" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $ob }}
                </span>
            </a>
        </li>
        <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-organization"></i> Product
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="nav-icon icon-organization"></i> Product Warehouse
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.display') }}">
                    <i class="nav-icon icon-screen-desktop"></i> Product Display
                </a>
            </li>
        </ul>
        </li>
        <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon fas fa-truck"></i> SPB
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('datastore.index') }}">
                    <i class="nav-icon fas fa-box-open"></i> BBK
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('datastore.bbm') }}">
                    <i class="nav-icon fas fa-box"></i> BBM
                </a>
            </li>
        </ul>
        </li>
        <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-note"></i> Laporan
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.daily') }}">
                    <i class="nav-icon icon-notebook"></i> Akhiri Shift
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.inquiry') }}">
                    <i class="nav-icon icon-calculator"></i> Inquiry Transaksi
                </a>
            </li>
        </ul>
        </li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-settings"></i> Pengaturan
        </a>
        <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.index') }}">
                        <i class="nav-icon icon-bag"></i> Toko
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
