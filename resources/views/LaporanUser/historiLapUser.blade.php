@extends('layout.navigasi')

@section('content')
<link rel="stylesheet" href="{{ asset('css/csshistorilap.css') }}">

<div class="container py-4">
    <h1 class="text-center mb-5">Histori Laporan</h1>

    @foreach($laporans as $laporan)
    <div class="card shadow">
        <div class="card-header bg-light">
        <h5 class="mb-0">Laporan Tanggal {{ \Carbon\Carbon::parse($laporan->created_at)->format('d-m-Y') }}</h5>
        </div>
        <div class="card-body">
            <div class="media-container">
                @if($laporan->foto)
                <div class="media-item" data-bs-toggle="modal" data-bs-target="#imageModal{{ $loop->iteration }}">
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan">
                </div>
                @endif

                @if($laporan->video)
                <div class="media-item" data-bs-toggle="modal" data-bs-target="#videoModal{{ $loop->iteration }}">
                    <video>
                        <source src="{{ asset('storage/' . $laporan->video) }}" type="video/mp4">
                    </video>
                </div>
                @endif
            </div>

            <div class="description">
                <p class="mb-0">{{ $laporan->deskripsi }}</p>
            </div>
        </div>
    </div>

    <!-- Modal for Image -->
    <div class="modal fade" id="imageModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $loop->iteration }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel{{ $loop->iteration }}">Foto Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Video -->
    <div class="modal fade" id="videoModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $loop->iteration }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel{{ $loop->iteration }}">Video Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <video controls class="rounded">
                        <source src="{{ asset('storage/' . $laporan->video) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if($laporans->isEmpty())
    <div class="text-center py-5">
        <p class="text-muted">Belum ada laporan yang dibuat.</p>
    </div>
    @endif
</div>
@endsection