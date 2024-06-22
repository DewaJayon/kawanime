@extends('layouts.dashboard.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tambah Banner</h5>
                    <div class="card-body">
                        <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="title" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" value="{{ old('title', $banner->title) }}" id="title" name="title"
                                        placeholder="Judul">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="url" class="col-md-2 col-form-label">URL</label>
                                <div class="col-md-10">
                                    <input class="form-control @error('url') is-invalid @enderror" type="url" value="{{ old('url', $banner->url) }}" id="url" name="url" placeholder="URL">
                                    @error('url')
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
                                        <input class="form-check-input" type="checkbox" id="status" name="status" @if (old('status', $banner->status == 1)) checked @endif>
                                        <label class="form-check-label" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="category" class="col-md-2 col-form-label">Category</label>
                                <div class="col-md-10">
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category" aria-label="Pilih Category" name="category_id">
                                        <option hidden>Pilih Category</option>
                                        @foreach ($categories as $category)
                                            @if (old('category_id', $banner->category_id) == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                                <div class="col-md-10">
                                    <input id="description" type="hidden" name="description" value="{{ old('description', $banner->description) }}">
                                    <trix-editor input="description"></trix-editor>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="image" class="col-md-2 col-form-label">Banner (1172x564)</label>
                                <div class="col-md-8 mb-3">
                                    <input type="hidden" name="old_image" value="{{ $banner->image }}">
                                    <input class="form-control @error('image') is-invalid @enderror " type="file" id="image" name="image" onchange="previewImage(event)">
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-2 mb-3">
                                    @if ($banner->image)
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Image" class="img-fluid" id="img-preview">
                                    @else
                                        <img src="{{ asset('images/default.svg') }}" alt="Image" class="img-fluid" id="img-preview">
                                    @endif
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
