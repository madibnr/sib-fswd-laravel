<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Staff')
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                    Dashboard
                </a>
            @endif

            @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Staff')
                <div class="sb-sidenav-menu-heading">Content</div>
                <a class="nav-link" href="{{ route('slider.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                    Slider
                </a>
            @endif

            <div class="sb-sidenav-menu-heading">Management</div>
            @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Staff')
                <a class="nav-link" href="{{ route('kategori.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Kategori
                </a>

                <a class="nav-link" href="{{ route('produk.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-hashtag"></i></div>
                    Produk
                </a>
            @endif
            @if (Auth::user()->role->name == 'Admin')
                <a class="nav-link" href="{{ route('role.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Role
                </a>
                <a class="nav-link" href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    User
                </a>
            @endif
            @if (Auth::user()->role->name == 'User')
                <a class="nav-link" href="{{ route('produk.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Produk
                </a>
            @endif

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
    </div>
</nav>