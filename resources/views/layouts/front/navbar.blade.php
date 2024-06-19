<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('home') }}">
                        <h3 class="logo text-white">KawaNime</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">Homepage</a>
                            </li>
                            <li class="{{ Request::routeIs(['list-anime', 'anime-detail']) ? 'active' : '' }}">
                                <a href="{{ route('list-anime') }}">List Anime</a>
                            </li>
                            <li class="{{ Request::routeIs(['list-movie', 'movie-detail']) ? 'active' : '' }}">
                                <a href="{{ route('list-movie') }}">Movie
                                </a>
                            </li>
                            <li><a href="#">Live Action</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
