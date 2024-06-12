<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <title>{{ $title }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite([
        //
        'resources/css/front/bootstrap.min.css',
        'resources/sass/front/style.scss',
        'resources/css/front/font-awesome.min.css',
        'resources/css/front/elegant-icons.css',
        'resources/css/front/nice-select.css',
        'resources/css/front/owl.carousel.min.css',
        'resources/css/front/slicknav.min.css',
        'resources/css/front/style.css',
    ])
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('layouts.front.navbar')
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    @include('layouts.front.footer')
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @vite([
        //
        'resources/js/app.js',
        'resources/js/front/jquery.nice-select.min.js',
        'resources/js/front/mixitup.min.js',
        'resources/js/front/jquery.slicknav.js',
        'resources/js/front/owl.carousel.min.js',
        'resources/js/front/main.js',
    ])

    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>

</body>

</html>
