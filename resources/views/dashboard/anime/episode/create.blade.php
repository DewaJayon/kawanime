@extends('layouts.dashboard.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Episode /</span> {{ $anime->title }}</h4>
        <div class="row">
            <div class="col-12">
                <div class="mb-3 alert-danger text-danger d-none">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Episode {{ $anime->title }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.anime.episode.store', $anime->slug) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Judul Episode" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="episode">Episode</label>
                                        <input type="text" class="form-control @error('episode') is-invalid @enderror" id="episode" placeholder="Masukkan Episode" name="episode"
                                            value="{{ old('episode') }}">
                                        @error('episode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="duration">Durasi</label>
                                        <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" placeholder="Masukkan Durasi" name="duration"
                                            value="{{ old('duration') }}">
                                        @error('duration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="mb-3">
                                        <label class="form-label" for="video">Video</label>
                                        <div class="input-group input-group-merge">
                                            <input type="file" id="video" class="form-control @error('video') is-invalid @enderror " name="video" onchange="previewVideo(event)">
                                        </div>
                                        <div class="form-text">Upload Video</div>
                                        @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="demo-vertical-spacing">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <video src="" id="video-preview" class="img-thumbnail"></video>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="mb-3">
                                        <label class="form-label" for="thumbnail">Thumnail (Optional)</label>
                                        <div class="input-group input-group-merge">
                                            <input type="file" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" onchange="previewImage(event)">
                                        </div>
                                        <div class="form-text">Upload Thumnail</div>
                                        @error('thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <img src="" id="img-preview" class="img-thumbnail" id="img-preview">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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
        var previewVideo = function(event) {
            var output = document.getElementById('video-preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        $(function() {
            $(document).ready(function() {
                $('form').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        var percentageVal = percentage + '%';
                        $('.progress .progress-bar').html(percentageVal);
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        if (xhr.status === 200) {
                            Swal.fire({
                                title: "Success",
                                text: "Episode Telah Di Tambahkan",
                                icon: "success",
                            });
                            window.location.href = "{{ route('dashboard.anime.episode', $anime->slug) }}";
                        } else {
                            $('.alert-danger').removeClass('d-none');
                            $('.alert-danger').html("<ul>")
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('.alert-danger ul').append("<li>" + value + "</li>");
                            });
                            $('.alert-danger').append("</ul>")
                        }
                    },
                });
            });
        });
    </script>
@endsection
