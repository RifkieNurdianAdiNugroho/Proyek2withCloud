@section('sidebar')
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (Auth::user()->role == 'admin')
                    <li class="sidebar-item {{ Request::segment(2) === 'dashboard' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.admin') }}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Applications</span>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'goods' ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('goods.index') }}" aria-expanded="false">
                            <i data-feather="package" class="feather-icon"></i>
                            <span class="hide-menu">Manajemen Barang</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'sellers' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('sellers.index') }}" aria-expanded="false">
                            <i data-feather="user" class="feather-icon"></i>
                            <span class="hide-menu">Manajemen Penjual</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'buyers' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('buyers.index') }}" aria-expanded="false">
                            <i data-feather="users" class="feather-icon"></i>
                            <span class="hide-menu">Manajemen Pembeli</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'transactions' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('transactions.index') }}" aria-expanded="false">
                            <i data-feather="credit-card" class="feather-icon"></i>
                            <span class="hide-menu">Transaksi</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'penjual')
                    <li class="sidebar-item {{ Request::segment(2) === 'dashboard' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.seller') }}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Applications</span>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'goods' ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('goods.index') }}" aria-expanded="false">
                            <i data-feather="package" class="feather-icon"></i>
                            <span class="hide-menu">Manajemen Barang</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'transactions' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('transactions.index') }}" aria-expanded="false">
                            <i data-feather="credit-card" class="feather-icon"></i>
                            <span class="hide-menu">Transaksi</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'pembeli')
                    <li class="sidebar-item {{ Request::segment(2) === 'dashboard' ? 'selected' : '' }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.buyer') }}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Applications</span>
                    </li>
                    <li class="sidebar-item {{ Request::segment(1) === 'transactions' ? 'selected' : '' }}"">
                        <a class="sidebar-link sidebar-link" href="{{ route('transactions.index') }}" aria-expanded="false">
                            <i data-feather="credit-card" class="feather-icon"></i>
                            <span class="hide-menu">Riwayat Transaksi</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
@show
