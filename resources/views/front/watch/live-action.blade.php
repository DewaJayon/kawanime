@extends('layouts.front.index')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">{{ $liveAction->category->name }}</a>
                        <a href="{{ route('live-action-detail', $liveAction->slug) }}">{{ $liveAction->title }}</a>
                        <span>{{ $liveAction->title }}</span>
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
                            <source src="{{ asset('storage/' . $liveAction->video) }}" type="video/mp4" />
                        </video>
                    </div>
                    <div class="anime__details__title mb-3">
                        <h3>{{ $liveAction->title }}</h3>
                    </div>
                    <br>
                    <section class="anime-details spad">
                        <div class="container">
                            <div class="anime__details__content">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $liveAction->thumbnail) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="anime__details__text">
                                            <div class="anime__details__title">
                                                <h3>{{ $liveAction->title }}</h3>
                                            </div>
                                            <div class="text-white">
                                                <p>{!! $liveAction->description !!}</p>
                                            </div>
                                            <div class="anime__details__widget">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <ul>
                                                            <li><span>Type:</span> {{ $liveAction->category->name }}</li>
                                                            <li><span>Durasi:</span> {{ $liveAction->duration }}</li>
                                                            <li><span>Rilis:</span> {{ Carbon\Carbon::parse($liveAction->release_date)->format('d F Y') }}</li>
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
