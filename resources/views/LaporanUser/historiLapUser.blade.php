@extends('layout.navigasi')

@section('content')
<head>
    <link href="{{ asset('css/csshistorilap.css') }}" rel="stylesheet">
</head>
<h1 class="text-center m-5">Histori Laporan</h1>

@foreach($laporans as $laporan)
<div class="card shadow mb-4" style="border-radius: 10px;">
    <div class="card-header bg-light" style="border-radius: 10px 10px 0 0;">
        <h5 class="mb-0">Laporan Bulan {{ $loop->iteration }}</h5>
    </div>
    <div class="card-body" style="background-color: #C4C4C4;">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto" class="img-fluid m-3" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal{{ $loop->iteration }}">
                <img src="{{ asset('storage/' . $laporan->video) }}" alt="Thumbnail Video" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#videoModal{{ $loop->iteration }}">
            </div>
        </div>
        <div class="col-md-10">
            <p>{{ $laporan->deskripsi }}</p>
        </div>
    </div>
</div>

<!-- Modal for Image -->
<div class="modal fade" id="imageModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $loop->iteration }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel{{ $loop->iteration }}">Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto" class="img-fluid rounded w-50">
            </div>
        </div>
    </div>
</div>

<!-- Modal for Video -->
<div class="modal fade" id="videoModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $loop->iteration }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel{{ $loop->iteration }}">Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <video controls class="w-50">
                    <source src="{{ asset('storage/' . $laporan->video) }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
