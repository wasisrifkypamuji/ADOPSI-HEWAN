<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
    @extends('layout.navigasi')

    @section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Donasi Hewan</h2>
        
        <a href="{{ route('donasi.create') }}" class="btn btn-primary mb-4" 
           style="background-color: #ff6b35; border: none;">
            Donasikan Hewan
        </a>

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
                @forelse($donations as $donation)
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
                                        <p class="mb-2">Status: 
                                            <span class="badge {{ 
                                                $donation->status == 'proses' ? 'bg-warning' : 
                                                ($donation->status == 'disetujui' ? 'bg-success' : 
                                                ($donation->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
                                            }}">
                                                {{ $donation->status_label }}
                                            </span>
                                        </p>
                                        
                                        <div class="action-buttons">
                                            @if($donation->status == 'proses')
                                                <form action="{{ route('donasi.batalkan', $donation->id_kirim) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin membatalkan donasi?')">
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @elseif($donation->status == 'disetujui')
                                                <a href="{{ route('acc-donasi.bukti-terima', $donation->id_kirim) }}" 
                                                   class="btn btn-success btn-sm"
                                                   target="_blank">
                                                    Unduh Bukti Terima
                                                </a>
                                            @elseif($donation->status == 'ditolak')
                                                <p class="text-danger mb-0">
                                                    Permintaan donasi ditolak karena ketentuan yang berlaku tidak terpenuhi
                                                </p>
                                            @endif
                                        </div>
                                        
                                        <button type="button" 
                                                class="btn btn-info btn-sm mt-2" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal{{ $donation->id_kirim }}">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal{{ $donation->id_kirim }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Donasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ Storage::url($donation->foto) }}" 
                                                 class="img-fluid rounded mb-3"
                                                 alt="{{ $donation->nama_hewan }}">
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tr>
                                                    <th>Nama Hewan</th>
                                                    <td>{{ $donation->nama_hewan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <td>{{ $donation->nama_kategori }}</td>
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
                                                        <span class="badge {{ 
                                                            $donation->status == 'proses' ? 'bg-warning' : 
                                                            ($donation->status == 'disetujui' ? 'bg-success' : 
                                                            ($donation->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
                                                        }}">
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
                                    @if($donation->status == 'disetujui')
                                        <a href="{{ route('acc-donasi.bukti-terima', $donation->id_kirim) }}" 
                                        class="btn btn-success btn-sm"
                                        target="_blank">
                                            Unduh Bukti Terima
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p>Belum ada donasi hewan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .btn-primary {
            background-color: #ff6b35;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e55a2b;
        }
        .btn-danger {
            padding: 5px 15px;
        }
        .btn-success {
            padding: 5px 15px;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
            color: white;
        }
        .modal-lg {
            max-width: 800px;
        }
        .list-group-item {
            transition: all 0.2s ease;
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
        .badge {
            padding: 0.5em 0.75em;
        }
        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .action-buttons {
            margin-top: 10px;
        }
        .img-preview {
            max-width: 100%;
            max-height: 150px;
            border-radius: 5px;
        }
    </style>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html