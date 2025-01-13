@extends('layout.navigasiadmin')

@section('content')
<div class="container-fluid px-4 py-4">
    <h2 class="mb-4">Donasi Hewan</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light p-4 rounded">
        <div class="row g-4">
            @forelse($pending_donations as $donation)
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-sm-row gap-3">
                                <div class="flex-shrink-0">
                                    <img src="{{ Storage::url($donation->foto) }}" 
                                         alt="{{ $donation->nama_hewan }}"
                                         class="rounded img-fluid"
                                         style="width: 180px; height: 180px; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-2">{{ $donation->nama_hewan }}</h4>
                                    <p class="mb-1">
                                        <strong>Pendonasi:</strong> 
                                        {{ $donation->user->name ?? $donation->nama_lengkap }}
                                    </p>
                                    <p class="mb-2">
                                        <strong>Status:</strong>
                                        <span class="badge {{ $donation->status == 'disetujui' ? 'bg-success' : 
                                            ($donation->status == 'ditolak' ? 'bg-danger' : 
                                            ($donation->status == 'selesai' ? 'bg-info' : 'bg-warning')) }}">
                                            {{ $donation->status_label }}
                                        </span>
                                    </p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-info btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#formModal{{ $donation->id_kirim }}">
                                            Lihat Detail
                                        </button>
                                        
                                        @if($donation->status == 'proses')
                                            <form action="{{ route('acc-donasi.approve', $donation->id_kirim) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('acc-donasi.reject', $donation->id_kirim) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#rejectModal{{ $donation->id_kirim }}">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                        @if(in_array($donation->status, ['disetujui', 'selesai']))
                                            <div class="d-flex flex-wrap gap-2 mt-2">
                                                @if($donation->status == 'disetujui')
                                                    <form action="{{ route('admin.hewan.store') }}" 
                                                          method="POST" 
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id_kategori" value="{{ $donation->id_kategori }}">
                                                        <input type="hidden" name="nama_kategori" value="{{ $donation->nama_kategori }}">
                                                        <input type="hidden" name="nama_hewan" value="{{ $donation->nama_hewan }}">
                                                        <input type="hidden" name="umur" value="{{ intval($donation->usia) }}">
                                                        <input type="hidden" name="gender" value="{{ $donation->gender }}">
                                                        <input type="hidden" name="deskripsi" value="{{ $donation->deskripsi }}">
                                                        <input type="hidden" name="existing_foto" value="{{ $donation->foto }}">
                                                        <input type="hidden" name="ras" value="{{ $donation->ras ?? '-' }}">
                                                        <input type="hidden" name="status_adopsi" value="Tersedia">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            Upload Hewan
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <a href="{{ route('acc-donasi.bukti-terima', $donation->id_kirim) }}" 
                                                   class="btn btn-secondary btn-sm" 
                                                   target="_blank">
                                                    Lihat Bukti Terima
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="formModal{{ $donation->id_kirim }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Donasi Hewan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="{{ Storage::url($donation->foto) }}" 
                                             class="img-fluid rounded"
                                             alt="{{ $donation->nama_hewan }}">
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th width="30%">Pendonasi</th>
                                                <td>{{ $donation->user->name ?? $donation->nama_lengkap }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $donation->user->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kategori</th>
                                                <td>{{ $donation->nama_kategori }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Hewan</th>
                                                <td>{{ $donation->nama_hewan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Usia</th>
                                                <td>{{ $donation->usia }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $donation->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ras</th>
                                                <td>{{ $donation->ras ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <span class="badge {{ $donation->status == 'disetujui' ? 'bg-success' : 
                                                        ($donation->status == 'ditolak' ? 'bg-danger' : 
                                                        ($donation->status == 'selesai' ? 'bg-info' : 'bg-warning')) }}">
                                                        {{ $donation->status_label }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h6>Deskripsi:</h6>
                                    <p>{{ $donation->deskripsi }}</p>
                                </div>

                                <div class="mt-4">
                                    <h6>Dokumen:</h6>
                                    <div class="list-group">
                                        @if($donation->surat_perjanjian)
                                            <a href="{{ Storage::url($donation->surat_perjanjian) }}" 
                                               class="list-group-item list-group-item-action"
                                               target="_blank">
                                                Surat Perjanjian
                                            </a>
                                        @endif
                                        
                                        @if($donation->surat_keterangan_sehat)
                                            <a href="{{ Storage::url($donation->surat_keterangan_sehat) }}" 
                                               class="list-group-item list-group-item-action"
                                               target="_blank">
                                                Surat Keterangan Sehat
                                            </a>
                                        @endif
                                        
                                        @if($donation->video)
                                            <a href="{{ Storage::url($donation->video) }}" 
                                               class="list-group-item list-group-item-action"
                                               target="_blank">
                                                Video Hewan
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tolak -->
                <div class="modal fade" id="rejectModal{{ $donation->id_kirim }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menolak permintaan donasi ini?</p>
                                <form action="{{ route('acc-donasi.reject', $donation->id_kirim) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Alasan Penolakan:</label>
                                        <textarea class="form-control" name="alasan_penolakan" rows="3" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="mb-0">Tidak ada permintaan donasi.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.card {
    border: 1px solid rgba(0,0,0,.125);
    box-shadow: 0 1px 3px rgba(0,0,0,.1);
}
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
    margin: 0.125rem;
}
.badge {
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.35em 0.65em;
}
.modal-body img {
    max-height: 400px;
    width: 100%;
    object-fit: contain;
}
.list-group-item {
    padding: 0.75rem 1.25rem;
}
.gap-2 {
    gap: 0.5rem !important;
}
.gap-3 {
    gap: 1rem !important;
}
.gap-4 {
    gap: 1.5rem !important;
}
</style>
@endsection
