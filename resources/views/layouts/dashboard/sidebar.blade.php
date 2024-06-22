<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">Dashboard</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item {{ request()->routeIs(['anime.*', 'dashboard.anime.episode*', 'movie.*', 'live-action.*']) ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="anime">Content</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('anime.*', 'dashboard.anime.episode*') ? 'active' : '' }}">
                    <a href="{{ route('anime.index') }}" class="menu-link">
                        <div data-i18n="anime">Anime</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('movie.*') ? 'active' : '' }}">
                    <a href="{{ route('movie.index') }}" class="menu-link">
                        <div data-i18n="Movie">Movie</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('live-action.*') ? 'active' : '' }}">
                    <a href="{{ route('live-action.index') }}" class="menu-link">
                        <div data-i18n="Live Action">Live Action</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->routeIs(['genre.*', 'category.*', 'banner.*']) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="General">General</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('banner.*') ? 'active' : '' }}">
                    <a href="{{ route('banner.index') }}" class="menu-link">
                        <div data-i18n="Banner">Banner</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('genre.*') ? 'active' : '' }}">
                    <a href="{{ route('genre.index') }}" class="menu-link">
                        <div data-i18n="Genre">Genre</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="menu-link">
                        <div data-i18n="Category">Category</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Extra</span></li>
        <li class="menu-item">
            <a href="{{ route('home') }}" target="_blank" class="menu-link">
                <i class='bx bx-globe menu-icon'></i>
                <div data-i18n="Support">Lihat Website</div>
            </a>
        </li>
    </ul>
</aside>
