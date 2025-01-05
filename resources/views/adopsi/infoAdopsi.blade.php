@extends('layout.navigasi')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Formulir Adopsi {{ $adoption->nama_hewan }}</h1>

    <!-- Status Adopsi -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="alert {{ $adoption->status_adopsi == 'pending' ? 'alert-warning' : 'alert-success' }}">
                <h5 class="alert-heading">Status Adopsi: 
                    <span class="badge {{ $adoption->status_adopsi == 'pending' ? 'bg-warning' : 'bg-success' }}">
                        {{ $adoption->status_adopsi == 'pending' ? 'Menunggu' : 'Disetujui' }}
                    </span>
                </h5>
                <p class="mb-0">Tanggal Pengajuan: {{ $adoption->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Acordion adopsi -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="accordion w-100" id="accordionSyarat">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <strong>Persyaratan Adopsi</strong>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" 
                             aria-labelledby="headingOne" data-bs-parent="#accordionSyarat">
                            <div class="accordion-body">
                                <ol class="mb-0">
                                    <li class="mb-2">Berusia minimal 21 tahun atau sudah menikah</li>
                                    <li class="mb-2">Memiliki KTP dan tempat tinggal tetap</li>
                                    <li class="mb-2">Memiliki penghasilan tetap</li>
                                    <li class="mb-2">Mendapat persetujuan dari semua anggota keluarga</li>
                                    <li class="mb-2">Bersedia untuk dilakukan survei tempat tinggal</li>
                                    <li class="mb-2">Siap bertanggung jawab atas kebutuhan hewan adopsi</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <strong>Ketentuan Adopsi</strong>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" 
                             aria-labelledby="headingTwo" data-bs-parent="#accordionSyarat">
                            <div class="accordion-body">
                                <ol class="mb-0">
                                    <li class="mb-2">Hewan adopsi tidak untuk diperjualbelikan</li>
                                    <li class="mb-2">Bersedia mengirimkan update kondisi hewan secara berkala</li>
                                    <li class="mb-2">Bersedia mengembalikan hewan jika ditemukan pelanggaran</li>
                                    <li class="mb-2">Mengisi form perjanjian adopsi dengan lengkap</li>
                                    <li class="mb-2">Bersedia untuk dihubungi terkait survei pasca adopsi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form adopsi -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Data Diri -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3">Data Diri</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ $adoption->nama_lengkap }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $adoption->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" value="{{ $adoption->no_telepon }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" rows="3" readonly>{{ $adoption->alamat }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" value="{{ $adoption->pekerjaan }}" readonly>
                        </div>
                    </div>

                    <!-- Pertanyaan -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3">Pertanyaan Kualifikasi</h5>
                        <div class="mb-3">
                            <label class="form-label">1. Apakah Anda memiliki pengalaman memelihara hewan?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q1 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">2. Berapa banyak waktu yang dapat Anda luangkan untuk merawat hewan?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q2 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">3. Apakah Anda memiliki hewan peliharaan lain? Jika ya, sebutkan.</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q3 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">4. Apakah semua anggota keluarga setuju dengan adopsi ini?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q4 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">5. Dimana hewan akan tinggal? (Indoor/Outdoor)</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q5 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">6. Bagaimana rencana perawatan kesehatan hewan?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q6 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">7. Apakah Anda siap dengan biaya perawatan hewan?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q7 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">8. Bagaimana rencana Anda jika harus berpergian?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q8 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">9. Mengapa Anda ingin mengadopsi hewan ini?</label>
                            <textarea class="form-control" rows="2" readonly>{{ $adoption->pertanyaan->q9 }}</textarea>
                        </div>
                    </div>

                    <!-- Surat Perjanjian -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3">Surat Perjanjian</h5>
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $adoption->pertanyaan->surat_perjanjian) }}" 
                               class="btn btn-primary" target="_blank">
                                <i class="bi bi-file-earmark-text me-2"></i>Lihat Surat Perjanjian
                            </a>
                        </div>
                    </div>

                    <div class="d-grid">
                        <a href="{{ route('adopsi.my-adoptions') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
