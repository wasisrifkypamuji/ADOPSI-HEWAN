@extends('layout.navigasiadmin')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Permintaan Adopsi</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($adoptions->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada permintaan adopsi.
        </div>
    @else
        <div class="row g-4">
            @foreach($adoptions as $adoption)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/'.$adoption->hewan->foto) }}" 
                             class="card-img-top" 
                             alt="{{ $adoption->hewan->nama_hewan }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h4 class="card-title">{{ $adoption->hewan->nama_hewan }}</h4>
                            <p class="text-muted mb-2">Pemohon: {{ $adoption->user->nama_lengkap }}</p>
                            
                            <!-- Status Badge dengan warna yang sesuai -->
                            <p class="mb-3">
                                @if($adoption->status_adopsi == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($adoption->status_adopsi == 'Disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-warning">Sedang DiProses</span>
                                @endif
                            </p>

                            <!-- Tampilkan alasan penolakan jika ditolak -->
                            @if($adoption->status_adopsi == 'Ditolak' && $adoption->alasan_penolakan)
                                <div class="alert alert-danger py-2 mb-3">
                                    <small><strong>Alasan penolakan:</strong><br>
                                    {{ $adoption->alasan_penolakan }}</small>
                                </div>
                            @endif

                            <div class="d-flex flex-column gap-2">
                                <button type="button" 
                                        class="btn btn-success"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailModal{{ $adoption->id_adopsi }}">
                                    Lihat Formulir
                                </button>

                                @if($adoption->status_adopsi == 'pending')
                                    <div class="d-flex gap-2">
                                        <button type="button" 
                                                class="btn btn-primary flex-grow-1"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#acceptModal{{ $adoption->id_adopsi }}">
                                            Terima
                                        </button>
                                        <button type="button" 
                                                class="btn btn-danger flex-grow-1"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rejectModal{{ $adoption->id_adopsi }}">
                                            Tolak
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="detailModal{{ $adoption->id_adopsi }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Formulir Adopsi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <h6 class="border-bottom pb-2">Data Pemohon</h6>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p><strong>Nama:</strong> {{ $adoption->user->nama_lengkap }}</p>
                                        <p><strong>Email:</strong> {{ $adoption->user->email }}</p>
                                        <p><strong>No. Telepon:</strong> {{ $adoption->user->no_telepon }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Pekerjaan:</strong> {{ $adoption->user->pekerjaan }}</p>
                                        <p><strong>Alamat:</strong> {{ $adoption->user->alamat }}</p>
                                    </div>
                                </div>

                                <h6 class="border-bottom pb-2">Jawaban Kualifikasi</h6>
                                <div class="mb-4">
                                    <p><strong>1. Pengalaman memelihara hewan:</strong><br>
                                    {{ $adoption->pertanyaan->q1 }}</p>
                                    
                                    <p><strong>2. Waktu yang dapat diluangkan:</strong><br>
                                    {{ $adoption->pertanyaan->q2 }}</p>
                                    
                                    <p><strong>3. Hewan peliharaan lain:</strong><br>
                                    {{ $adoption->pertanyaan->q3 }}</p>
                                    
                                    <p><strong>4. Persetujuan keluarga:</strong><br>
                                    {{ $adoption->pertanyaan->q4 }}</p>
                                    
                                    <p><strong>5. Tempat tinggal hewan:</strong><br>
                                    {{ $adoption->pertanyaan->q5 }}</p>
                                    
                                    <p><strong>6. Rencana perawatan kesehatan:</strong><br>
                                    {{ $adoption->pertanyaan->q6 }}</p>
                                    
                                    <p><strong>7. Kesiapan biaya:</strong><br>
                                    {{ $adoption->pertanyaan->q7 }}</p>
                                    
                                    <p><strong>8. Rencana saat bepergian:</strong><br>
                                    {{ $adoption->pertanyaan->q8 }}</p>
                                    
                                    <p><strong>9. Alasan adopsi:</strong><br>
                                    {{ $adoption->pertanyaan->q9 }}</p>
                                </div>

                                <h6 class="border-bottom pb-2">Dokumen</h6>
                                <div>
                                    <a href="{{ asset('storage/' . $adoption->pertanyaan->surat_perjanjian) }}" 
                                       class="btn btn-primary" 
                                       target="_blank">
                                        Lihat Surat Perjanjian
                                    </a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Terima -->
                <div class="modal fade" id="acceptModal{{ $adoption->id_adopsi }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Persetujuan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menyetujui permintaan adopsi ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('admin.adopsi.accept', $adoption->id_adopsi) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Ya, Setujui</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tolak -->
                <div class="modal fade" id="rejectModal{{ $adoption->id_adopsi }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menolak permintaan adopsi ini?</p>
                                <form action="{{ route('admin.adopsi.reject', $adoption->id_adopsi) }}" method="POST">
                                    @csrf
                                    @method('PUT')
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
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $adoptions->links() }}
        </div>
    @endif
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection