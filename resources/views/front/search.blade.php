@extends('layouts.front.index')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href=".{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Search</a>
                        <span>{{ Request::get('search') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Pencarian : {{ Request::get('search') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            @if (!$notFound)

                                @if (count($episode) > 0)
                                    @foreach ($episode as $item)
                                        <a href="{{ route('watch', $item->slug) }}">
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="product__item">
                                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/anime-thumbnail/' . $item->anime->thumbnail) }}">
                                                        <div class="ep">Episode {{ $item->episode }}</div>
                                                    </div>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            @foreach ($item->anime->genreOption as $genreItem)
                                                                <li>{{ $genreItem->genre->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <h5><a href="{{ route('watch', $item->slug) }}">{{ $item->title }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif

                                @if (count($anime) > 0)
                                    @foreach ($anime as $item)
                                        <a href="{{ route('anime-detail', $item->slug) }}">
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="product__item">
                                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/anime-thumbnail/' . $item->thumbnail) }}"></div>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            @foreach ($item->genreOption as $genreItem)
                                                                <li>{{ $genreItem->genre->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <h5><a href="{{ route('anime-detail', $item->slug) }}">{{ $item->title }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif

                                @if (count($movie) > 0)
                                    @foreach ($movie as $item)
                                        <a href="{{ route('movie-detail', $item->slug) }}">
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="product__item">
                                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $item->thumbnail) }}"></div>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            @foreach ($item->genreOption as $genreItem)
                                                                <li>{{ $genreItem->genre->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <h5><a href="{{ route('movie-detail', $item->slug) }}">{{ $item->title }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif

                                @if (count($liveAction) > 0)
                                    @foreach ($liveAction as $item)
                                        <a href="{{ route('live-action-detail', $item->slug) }}">
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="product__item">
                                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $item->thumbnail) }}"></div>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            @foreach ($item->genreOption as $genreItem)
                                                                <li>{{ $genreItem->genre->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <h5><a href="{{ route('live-action-detail', $item->slug) }}">{{ $item->title }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            @else
                                <div class="container" style="height: 100vh">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h3 class="text-center text-white">Pencarian Tidak Ditemukan</h3>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-center align-items-center">
                        <div class="product__pagination">
                            {{ $search->links('layouts.front.paginate') }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
