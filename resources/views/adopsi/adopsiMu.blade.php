@extends('layout.navigasi')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">AdopsiMu</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    

    <div class="row g-4">
        @foreach($adoptions as $adoption)
        <div class="col-md-4">
            <div class="card h-100">
                <img src="{{ asset('storage/'.$adoption->hewan->foto) }}" class="card-img-top" alt="{{ $adoption->nama_hewan }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $adoption->nama_hewan }}</h5>
                    <p class="card-text">
                        Status: 
                        <span class="badge {{ $adoption->status_adopsi == 'pending' ? 'bg-warning' : 'bg-success' }}">
                            {{ $adoption->status_adopsi == 'pending' ? 'Menunggu' : 'Disetujui' }}
                        </span>
                    </p>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn-nav" data-bs-toggle="modal" data-bs-target="#detailModal{{ $adoption->id_adopsi }}">
                            Detail
                        </button>

                        @if($adoption->status_adopsi == 'pending')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $adoption->id_adopsi }}">
                                Batalkan
                            </button>
                        @elseif($adoption->status_adopsi == 'Disetujui')
                        <a href="#" class="btn btn-primary">Unduh Bukti Adopsii</a>
                        <a href="#" class="btn btn-success">Berikan laporan</a>
                        @else
                            <p class="text-muted">Status tidak diketahui</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- modal detail -->
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
                                    <span class="badge {{ $adoption->status_adopsi == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                        {{ $adoption->status_adopsi == 'pending' ? 'Menunggu' : 'Disetujui' }}
                                    </span>
                                </td>
                            </tr>
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

        <!-- konfirmasi bataal -->
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
        @endforeach
    </div>

    @if($adoptions->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted">Anda belum memiliki pengajuan adopsi.</p>
        </div>
    @endif
</div>
@endsection