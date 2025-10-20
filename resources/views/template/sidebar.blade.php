<aside class="main-sidebar sidebar-dark-purple elevation-4">

    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Inventory</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="/" class="nav-link active">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                {{-- Data Master - Hapus menu drop-down --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Master</p>
                    </a>
                </li> --}}
                
                {{-- Pindahkan item-item sub-menu di sini --}}
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link">
                        <i class="fas fa-layer-group nav-icon"></i>
                        <p>Kategori Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link">
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link">
                        <i class="fas fa-boxes nav-icon"></i>
                        <p>Produk</p>
                    </a>
                </li>

                {{-- Produk Masuk --}}
                <li class="nav-item">
                    <a href="{{ route('produk_masuk.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-circle-down"></i>
                        <p>Produk Masuk</p>
                    </a>
                </li>

                {{-- Produk Keluar --}}
                <li class="nav-item">
                    <a href="{{ route('produk_keluar.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-circle-up"></i>
                        <p>Produk Keluar</p>
                    </a>
                </li>

                {{-- Kelola User --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kelola User</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        </div>
    </aside>