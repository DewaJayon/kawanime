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
            <span class="text-muted fw-light">Live Action /</span>
            List Live Action
        </h4>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class=" table-responsive ">
                            <a href="{{ route('live-action.create') }}">
                                <button type="button" class="btn rounded-pill btn-outline-primary mb-4">Tambah LIve Action</button>
                            </a>
                            <table id="data-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Category</th>
                                        <th>Durasi</th>
                                        <th>Tanggal Rilis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liveActions as $liveAction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $liveAction->title }}</td>
                                            <td>{{ $liveAction->category->name }}</td>
                                            <td>{{ $liveAction->duration }}</td>
                                            <td>{{ $liveAction->release_date }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('live-action.show', $liveAction->slug) }}"><i class='bx bxs-show me-1'></i> Show</a>
                                                        <a class="dropdown-item" href="{{ route('live-action.edit', $liveAction->slug) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="{{ route('live-action.destroy', $liveAction->slug) }}" method="POST" class="">
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
