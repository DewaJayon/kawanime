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
            <span class="text-muted fw-light">Category /</span>
            List Category
        </h4>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <h5 class="card-header"> Category</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        @empty($category)
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                            @else
                                <form action="{{ route('category.update', $category->slug) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                @endempty
                                <div class="input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Category" autocomplete="off" name="name"
                                        value="{{ old('name', $category->name ?? '') }}">
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('category.edit', $category->slug) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="{{ route('category.destroy', $category->slug) }}" method="POST" class="">
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
