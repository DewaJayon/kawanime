@extends('layouts.front.index')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('movie-detail', $movie->slug) }}">Anime Detail</a>
                        <span>{{ $movie->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $movie->thumbnail) }}"></div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $movie->title }}</h3>
                            </div>
                            <div class="text-white">

                                <p>{!! $movie->description !!}</p>
                            </div>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> {{ $movie->category->name }}</li>
                                            <li><span>Durasi:</span> {{ $movie->duration }}</li>
                                            <li><span>Rilis:</span> {{ Carbon\Carbon::parse($movie->release_date)->format('d F Y') }}</li>
                                            <li><span>Genre:</span>
                                                @foreach ($genres as $genre)
                                                    {{ $genre }},
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="{{ route('watch.movie', $movie->slug) }}" class="watch-btn"><span>Tonton Sekarang</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
@endsection
