@extends('layouts.dashboard.index')
@section('content')
    @if (session()->has('success'))
        <div class="flash-data" data-swall="{{ session('success') }}"></div>
    @endif
    @if (session()->has('error'))
        <div class="flash-data" data-error="{{ session('error') }}"></div>
    @endif

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Anime /</span>
            List Anime
        </h4>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class=" table-responsive ">
                            <a href="{{ route('anime.create') }}">
                                <button type="button" class="btn rounded-pill btn-outline-primary mb-4">Tambah Anime</button>
                            </a>
                            <table id="data-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Studio</th>
                                        <th>Category</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($animes as $anime)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $anime->title }}</td>
                                            <td>{{ $anime->status }}</td>
                                            <td>{{ $anime->studio }}</td>
                                            <td>{{ $anime->category->name }}</td>
                                            <td>{{ Carbon\Carbon::parse($anime->airing_date)->format('d F Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-movie me-1'></i> Tambah Episode</a>
                                                        <a class="dropdown-item" href="{{ route('anime.show', $anime->slug) }}"><i class='bx bxs-show me-1'></i> Show</a>
                                                        <a class="dropdown-item" href="{{ route('anime.edit', $anime->slug) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="{{ route('anime.destroy', $anime->slug) }}" method="POST" class="">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
