@extends('layouts.dashboard.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-5">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img card-img-left" src="{{ asset('storage/anime-thumbnail/' . $anime->thumbnail) }}" alt="{{ $anime->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $anime->title }}</h5>
                                <p class="card-text">{!! $anime->description !!}</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Studio : {{ $anime->studio }}</li>
                                    <li class="list-group-item">Type : {{ $anime->category->name }}</li>
                                    <li class="list-group-item">Status : {{ $anime->status }}</li>
                                    <li class="list-group-item">Total Episode : {{ $anime->episode->count() }}</li>
                                    <li class="list-group-item">Tayang pada : {{ Carbon\Carbon::parse($anime->airing_date)->format('d F Y') }}</li>
                                </ul>
                                <a href="{{ route('anime.index') }}">
                                    <button type="button" class="btn rounded-pill btn-outline-success mb-4">Kembali ke List</button>
                                </a>
                                <a href="#">
                                    <button type="button" class="btn rounded-pill btn-outline-primary mb-4">Tambah Episode</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
