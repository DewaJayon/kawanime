@extends('layouts.front.index')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('list-live-action') }}">Live Action</a>
                        <span>List Live Action</span>
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
                                        <h4>List Live Action</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse ($liveActions as $liveAction)
                                <a href="{{ route('live-action-detail', $liveAction->slug) }}">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $liveAction->thumbnail) }}"></div>
                                            <div class="product__item__text">
                                                <h5><a href="{{ route('live-action-detail', $liveAction->slug) }}">{{ $liveAction->title }}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <h3>Belum Ada Live Action</h3>
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="product__pagination">
                            {{ $liveActions->links('layouts.front.paginate') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
