<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
            <a href="/user/dashboard" wire:navigate class="nav-link" wire:current="active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <x-menu-item link="/user/paketList" label="Paket" icon="fa-copy" />
        <x-menu-item link="/user/bookingList" label="Booking" icon="fa-calendar-alt" />
        <x-menu-item link="/user/paymentList" label="Pembayaran" icon="fa-calculator" />
        <li class="nav-item">
            <a wire:navigate href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
