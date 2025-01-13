@extends('layout.navigasi')

@section('content')
<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
</style>
<div class="container py-4">
    <h1 class="text-center mb-4">AdopsiMu</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($adoptions->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted">Anda belum memiliki pengajuan adopsi.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($adoptions as $adoption)
            <div class="col-md-4">
                <div class="card h-100" data-bs-toggle="modal" data-bs-target="#detailModal{{ $adoption->id_adopsi }}">
                    <img src="{{ asset('storage/'.$adoption->hewan->foto) }}" class="card-img-top" alt="{{ $adoption->nama_hewan }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $adoption->nama_hewan }}</h5>
                        <p class="card-text">
                            Status: 
                            @if($adoption->status_adopsi == 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($adoption->status_adopsi == 'Disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($adoption->status_adopsi == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif($adoption->status_adopsi == 'Dibatalkan')
                                <span class="badge bg-secondary">Dibatalkan</span>
                            @endif
                        </p>

                        <!-- Tampilkan alasan penolakan jika ditolak -->
                        @if($adoption->status_adopsi == 'Ditolak' && $adoption->alasan_penolakan)
                                <div class="alert alert-danger py-2 mb-3">
                                    <small><strong>Alasan penolakan:</strong><br>
                                    {{ $adoption->alasan_penolakan }}</small>
                                </div>
                            @endif

                        <div class="button-container">
                            <div class="d-flex gap-2">
                                @if($adoption->status_adopsi == 'pending')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $adoption->id_adopsi }}" onclick="event.stopPropagation()">
                                        Batalkan
                                    </button>   
                                @elseif($adoption->status_adopsi == 'Disetujui')
                                    <a href="{{ route('adopsi.download-pdf', $adoption->id_adopsi) }}" class="btn btn-warning" onclick="event.stopPropagation()">Unduh Bukti Adopsi</a>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#laporanModal{{ $adoption->id_adopsi }}">
                                        Berikan Laporan
                                    </button>
                                    <a href="{{ route('laporan.index', $adoption->id_adopsi) }}" class="btn btn-primary">Lihat Laporan</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Laporan -->
                <div class="modal fade" id="laporanModal{{ $adoption->id_adopsi }}" tabindex="-1" aria-labelledby="laporanModalLabel{{ $adoption->id_adopsi }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="laporanModalLabel{{ $adoption->id_adopsi }}">Form Laporan Adopsi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id_adopsi" value="{{ $adoption->id_adopsi }}">

                                    <div class="mb-3">
                                        <label for="deskripsi{{ $adoption->id_adopsi }}" class="form-label">Deskripsi Laporan</label>
                                        <textarea name="deskripsi" id="deskripsi{{ $adoption->id_adopsi }}" class="form-control" rows="4" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto{{ $adoption->id_adopsi }}" class="form-label">Foto / Bukti</label>
                                        <input type="file" name="foto" id="foto{{ $adoption->id_adopsi }}" class="form-control" accept="image/*" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="video{{ $adoption->id_adopsi }}" class="form-label">Video (Opsional)</label>
                                        <input type="file" name="video" id="video{{ $adoption->id_adopsi }}" class="form-control" accept="video/mp4">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="detailModal{{ $adoption->id_adopsi }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $adoption->id_adopsi }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $adoption->id_adopsi }}">Detail Adopsi {{ $adoption->nama_hewan }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/'.$adoption->hewan->foto) }}" class="img-fluid rounded" alt="{{ $adoption->nama_hewan }}">
                                </div>
                                <table class="table">
                                    <tr>
                                        <th>Jenis Hewan</th>
                                        <td>{{ $adoption->hewan->nama_kategori }}</td>
                                    </tr>
                                    <tr>
                                        <th>Umur</th>
                                        <td>{{ $adoption->hewan->umur }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $adoption->hewan->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengajuan</th>
                                        <td>{{ $adoption->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($adoption->status_adopsi == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($adoption->status_adopsi == 'Disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif($adoption->status_adopsi == 'Ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($adoption->status_adopsi == 'Ditolak' && $adoption->alasan_penolakan)
                                        <tr>
                                            <th>Alasan Penolakan</th>
                                            <td>{{ $adoption->alasan_penolakan }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Form Adopsi</th>
                                        <td><a href="{{ route('adopsi.view-form', $adoption->id_adopsi) }}" class="btn btn-success">Lihat Formulir</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi Pembatalan -->
                @if($adoption->status_adopsi == 'pending')
                <div class="modal fade" id="cancelModal{{ $adoption->id_adopsi }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $adoption->id_adopsi }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancelModalLabel{{ $adoption->id_adopsi }}">Konfirmasi Pembatalan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin membatalkan pengajuan adopsi {{ $adoption->nama_hewan }}?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <form action="{{ route('adopsi.cancel', $adoption->id_adopsi) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
