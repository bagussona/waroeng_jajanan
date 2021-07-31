<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>

        <li class="nav-title">MANAJEMEN PRODUK</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="nav-icon icon-drop"></i> Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier.index') }}">
                <i class="nav-icon icon-drop"></i> Supplier
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="nav-icon icon-drop"></i> Produk
            </a>
        </li>
        <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-settings"></i> SPB
        </a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('datastore.index') }}">
                    <i class="nav-icon icon-puzzle"></i> BBK
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('datastore.index') }}">
                    <i class="nav-icon icon-puzzle"></i> BBM
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
                        <i class="nav-icon icon-puzzle"></i> Toko
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
