@extends('layout.navigasiadmin')

@section('content')
<div class="container mt-4">
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
        <div class="row">
            @forelse($pending_donations as $donation)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="me-3">
                                    <img src="{{ Storage::url($donation->foto) }}" 
                                         alt="{{ $donation->nama_hewan }}"
                                         class="rounded"
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <div>
                                    <h4>{{ $donation->nama_hewan }}</h4>
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
                                    <div class="mb-2">
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
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $donation->id_kirim }}">
                                                    Tolak
                                                </button>
                                                
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
                                            </form>
                                        @endif

                                        @if($donation->status == 'disetujui')
                                        <div class="d-flex flex-column gap-2">
                                            @if($donation->status != 'selesai')
                                                <form action="{{ route('admin.hewan.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id_kategori" value="{{ $donation->id_kategori }}">
                                                    <input type="hidden" name="nama_kategori" value="{{ $donation->nama_kategori }}">
                                                    <input type="hidden" name="nama_hewan" value="{{ $donation->nama_hewan }}">
                                                    <input type="hidden" name="umur" value="{{ intval($donation->usia) }}">
                                                    <input type="hidden" name="gender" value="{{ $donation->gender }}">
                                                    <input type="hidden" name="deskripsi" value="{{ $donation->deskripsi }}">
                                                    <input type="hidden" name="existing_foto" value="{{ $donation->foto }}">
                                                    <input type="hidden" name="ras" value="-">
                                                    <input type="hidden" name="status_adopsi" value="Tersedia">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        Upload Hewan
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="{{ route('acc-donasi.bukti-terima', $donation->id_kirim) }}" 
                                            class="btn btn-secondary btn-sm"
                                            target="_blank">
                                                Unduh Bukti Terima
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
                <div class="modal fade" id="formModal{{ $donation->id_kirim }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Donasi Hewan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ Storage::url($donation->foto) }}" 
                                             class="img-fluid rounded"
                                             alt="{{ $donation->nama_hewan }}">
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th>Pendonasi</th>
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

                                <div class="mt-3">
                                    <h6>Deskripsi:</h6>
                                    <p>{{ $donation->deskripsi }}</p>
                                </div>

                                <div class="mt-3">
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
                                @if($donation->status == 'disetujui' && $donation->bukti_terima)
                                    <a href="{{ route('acc-donasi.download-bukti', $donation->id_kirim) }}" 
                                       class="btn btn-secondary btn-sm">
                                        Unduh Bukti Terima
                                    </a>
                                @endif
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Tidak ada permintaan donasi.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .btn-sm {
        padding: 5px 10px;
        margin: 2px;
    }
    .card {
        margin-bottom: 20px;
    }
    .badge {
        font-size: 0.875rem;
    }
</style>
@endsection