@extends('layouts.dashboard.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('storage/' . $banner->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $banner->title }}</h5>
                        <p class="card-text">
                            {!! $banner->description !!}
                        </p>
                        <a href="{{ route('banner.index') }}" class="btn btn-outline-primary">Kembali ke List Banner</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
