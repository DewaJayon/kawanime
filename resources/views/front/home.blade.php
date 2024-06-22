@extends('layouts.front.index')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                @foreach ($banners as $banner)
                    <div class="hero__items set-bg" data-setbg="{{ asset('storage/' . $banner->image) }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <div class="label">{{ $banner->category->name }}</div>
                                    <h2>{{ $banner->title }}</h2>
                                    <div class="text-white">
                                        <p class="text-white">{!! Str::limit($banner->description, 50) !!}</p>
                                    </div>
                                    <a href="{{ $banner->url }}"><span>Tonton Sekarang</span> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Anime Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Sedang Tayang</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('list-anime') }}" class="primary-btn">Lihat Semua <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row rounded p-3" style="border: 1px solid white">
                            @forelse ($episodes as $anime)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6 ">
                                    <a href="{{ route('watch', $anime->slug) }}">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/anime-thumbnail/' . $anime->anime->thumbnail) }}">
                                                <div class="ep">Episode {{ $anime->episode }}</div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    @foreach ($anime->anime->genreOption as $item)
                                                        <li>{{ $item->genre->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <h5><a href="{{ route('watch', $anime->slug) }}">{{ $anime->title }}</a></h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <h3>Belum Ada Anime</h3>
                            @endforelse
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="product__pagination">
                                {{ $episodes->links('layouts.front.paginate') }}
                            </div>
                        </div>
                    </div>

                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Movie</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('list-movie') }}" class="primary-btn">Lihat Semua <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse ($movies as $movie)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6 ">
                                    <a href="{{ route('watch.movie', $movie->slug) }}">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $movie->thumbnail) }}">
                                                <div class="ep">Movie</div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    @foreach ($movie->genreOption as $item)
                                                        <li>{{ $item->genre->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <h5><a href="{{ route('watch', $movie->slug) }}">{{ $movie->title }}</a></h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <h3>Belum Ada Movie</h3>
                            @endforelse
                        </div>
                    </div>

                    <div class="live__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Live Action</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">Lihat Semua <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse ($liveActions as $liveAction)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6 ">
                                    <a href="{{ route('watch.live-action', $liveAction->slug) }}">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $liveAction->thumbnail) }}">
                                                <div class="ep">Live Action</div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    @foreach ($liveAction->genreOption as $item)
                                                        <li>{{ $item->genre->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <h5><a href="{{ route('watch.live-action', $liveAction->slug) }}">{{ $liveAction->title }}</a></h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <h3>Belum Ada Live Action</h3>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
