@extends('layouts.front.index')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg" data-setbg="https://dummyimage.com/1172x564/808080/fff">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="https://dummyimage.com/1172x564/808080/fff">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="https://dummyimage.com/1172x564/808080/fff">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="https://dummyimage.com/230x325/808080/fff">
                                        <div class="ep">18 / 18</div>
                                        <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Active</li>
                                            <li>Movie</li>
                                        </ul>
                                        <h5><a href="#">Shouwa Genroku Rakugo Shinjuu</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
