@extends('layouts.front.index')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">{{ $movie->category->name }}</a>
                        {{-- <a href="{{ route('anime-detail', $anime->slug) }}">{{ $anime->title }}</a> --}}
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        <video id="player" playsinline controls>
                            <source src="{{ asset('storage/' . $movie->video) }}" type="video/mp4" />
                        </video>
                    </div>
                    <div class="anime__details__title mb-3">
                        <h3>{{ $movie->title }}</h3>
                    </div>
                    <br>
                    {{-- <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>List Episode</h5>
                        </div>
                        @foreach ($episodes as $episode)
                            <a href="{{ route('watch', $episode->slug) }}">Ep{{ $episode->episode }}</a>
                        @endforeach
                    </div> --}}
                    <section class="anime-details spad">
                        <div class="container">
                            <div class="anime__details__content">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $movie->thumbnail) }}">
                                        </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
@endsection
