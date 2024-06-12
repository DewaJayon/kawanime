@extends('layouts.dashboard.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tambah Anime</h5>
                    <div class="card-body">
                        <form action="{{ route('anime.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="title" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" value="{{ old('title') }}" id="title" name="title" placeholder="Judul Anime">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="status" class="col-md-2 col-form-label">Status</label>
                                <div class="col-md-10">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="status" name="status">
                                        <label class="form-check-label" for="status">Ongoing</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="studio" class="col-md-2 col-form-label">Studio</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('studio') is-invalid @enderror" type="text" value="{{ old('studio') }}" id="studio" name="studio" placeholder="Studio">
                                    @error('studio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="airing_date" class="col-md-2 col-form-label">Tanggal Tayang</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('airing_date') is-invalid @enderror" type="date" value="{{ old('airing_date') }}" id="airing_date" name="airing_date">
                                    @error('airing_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="category" class="col-md-2 col-form-label">Category</label>
                                <div class="col-md-10">
                                    <select class="form-select" id="category" aria-label="Pilih Category" name="category">
                                        <option hidden>Pilih Category</option>
                                        @foreach ($categories as $category)
                                            @if (old('category') == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                                <div class="col-md-10">
                                    <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                    <trix-editor input="description"></trix-editor>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="thumbnail" class="col-md-2 col-form-label">Thumbnail Anime</label>
                                <div class="col-md-8 mb-3">
                                    <input class="form-control" type="file" id="thumbnail" name="thumbnail" onchange="previewImage(event)">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <img src="{{ asset('images/default.svg') }}" alt="Image" class="img-fluid" id="img-preview">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="d-grid gap-2 col-lg-6 mx-auto">
                                    <button class="btn rounded-pill btn-outline-primary btn-lg" type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var previewImage = function(event) {
            var output = document.getElementById('img-preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection
