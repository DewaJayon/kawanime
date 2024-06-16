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
            <span class="text-muted fw-light">Genre /</span>
            List Gene
        </h4>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <h5 class="card-header"> Genre</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        @empty($genre)
                            <form action="{{ route('genre.store') }}" method="POST">
                                @csrf
                            @else
                                <form action="{{ route('genre.update', $genre->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                @endempty
                                <div class="input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Genre" autocomplete="off" name="name"
                                        value="{{ old('name', $genre->name ?? '') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn rounded-pill btn-outline-primary mt-3">Submit</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class=" table-responsive ">
                            <table id="data-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($genres as $genre)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $genre->name }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('genre.edit', $genre->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" class="">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item show-confirm"><i class="bx bx-trash me-1"></i> Delete</button>
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
