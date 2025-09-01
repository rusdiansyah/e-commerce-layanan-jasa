<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <x-menu-item link="/dashboard" label="Dashboard" icon="fa-tachometer-alt" />

        <li class="nav-item {{ request()->segment(1) == 'setting' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'setting' ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Setting
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <x-menu-item link="/setting/identitas" label="Identitas" />
                <x-menu-item link="/setting/favicon" label="Favicon" />
                <x-menu-item link="/setting/logo_login" label="Background Login" />
                <x-menu-item link="/setting/logo_home" label="Login Home" />
            </ul>
        </li>
        <li class="nav-item {{ request()->segment(1) == 'user' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Management User
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <x-menu-item link="/user/role" label="Role" />
                <x-menu-item link="/user/user" label="User" />
            </ul>
        </li>
        <x-menu-item link="/bannerList" label="Banner" icon="fa-images" />
        <li class="nav-item {{ request()->segment(1) == 'produk' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'produk' ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Produk
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <x-menu-item link="/produk/jenisPaketList" label="Jenis Paket" />
                <x-menu-item link="/produk/paketList" label="Paket" />
            </ul>
        </li>
        <x-menu-item link="/bookingList" label="Booking" icon="fa-calendar-alt" />
        <x-menu-item link="/paymentList" label="Pembayaran" icon="fa-calculator" />

        <x-menu-item link="/logout" label="Logout" icon="fa-sign-out-alt" />
    </ul>
</nav>
