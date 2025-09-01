<div>
    <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ $notifikasi->count() }}</span>
        </a>
        @if ($notifikasi->count() > 0)
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach ($notifikasi as $notif)
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ Str::of($notif->paket->nama)->limit(15) }}
                        <span class="float-right text-muted text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.bookingList') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        @endif
    </li>
</div>
