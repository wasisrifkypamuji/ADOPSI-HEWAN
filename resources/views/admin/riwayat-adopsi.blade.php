@extends('layout.navigasiadmin')

@section('content')
    <header class="bg-light py-3 text-center">
        <h1>Riwayat Adopsi</h1>
    </header>

    <section class="container my-4">
        @if ($adopsi->isEmpty())
            <div class="alert alert-warning text-center">
                Belum ada data adopsi.
            </div>
        @else
            <div class="row">
                @foreach ($adopsi as $adp)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $adp->hewan->foto) }}" class="card-img-top"
                                alt="{{ $adp->hewan->nama_hewan }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $adp->hewan->nama_hewan }}</h5>
                                <a href="#" class="btn btn-success d-block mt-8" data-bs-toggle="modal" data-bs-target="#formulir{{ $adp->id_adopsi }}">Lihat Formulir</a>
                                <a href="{{ route('admin.adopsi.laporan', $adp->id_adopsi) }}"
                                    class="btn btn-success d-block mt-2">Lihat Laporan</a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="formulir{{ $adp->id_adopsi }}" tabindex="-1">
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
                                            <p><strong>Nama:</strong> {{ $adp->user->nama_lengkap }}</p>
                                            <p><strong>Email:</strong> {{ $adp->user->email }}</p>
                                            <p><strong>No. Telepon:</strong> {{ $adp->user->no_telepon }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Pekerjaan:</strong> {{ $adp->user->pekerjaan }}</p>
                                            <p><strong>Alamat:</strong> {{ $adp->user->alamat }}</p>
                                        </div>
                                    </div>

                                    <h6 class="border-bottom pb-2">Jawaban Kualifikasi</h6>
                                    <div class="mb-4">
                                        <p><strong>1. Pengalaman memelihara hewan:</strong><br>
                                            {{ $adp->pertanyaan->q1 }}</p>

                                        <p><strong>2. Waktu yang dapat diluangkan:</strong><br>
                                            {{ $adp->pertanyaan->q2 }}</p>

                                        <p><strong>3. Hewan peliharaan lain:</strong><br>
                                            {{ $adp->pertanyaan->q3 }}</p>

                                        <p><strong>4. Persetujuan keluarga:</strong><br>
                                            {{ $adp->pertanyaan->q4 }}</p>

                                        <p><strong>5. Tempat tinggal hewan:</strong><br>
                                            {{ $adp->pertanyaan->q5 }}</p>

                                        <p><strong>6. Rencana perawatan kesehatan:</strong><br>
                                            {{ $adp->pertanyaan->q6 }}</p>

                                        <p><strong>7. Kesiapan biaya:</strong><br>
                                            {{ $adp->pertanyaan->q7 }}</p>

                                        <p><strong>8. Rencana saat bepergian:</strong><br>
                                            {{ $adp->pertanyaan->q8 }}</p>

                                        <p><strong>9. Alasan adopsi:</strong><br>
                                            {{ $adp->pertanyaan->q9 }}</p>
                                    </div>

                                    <h6 class="border-bottom pb-2">Dokumen</h6>
                                    <div>
                                        <a href="{{ asset('storage/' . $adp->pertanyaan->surat_perjanjian) }}"
                                            class="btn btn-primary" target="_blank">
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
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $adopsi->links() }}
            </div>
        @endif
    </section>

    <footer class="bg-light text-center py-4">
        <div class="container">
            <h5>Findpet.</h5>
            <p>Temukan teman setia Anda di Findpet - platform adopsi hewan terpercaya untuk memberi mereka rumah penuh
                kasih!</p>
            <p><a href="#" class="text-decoration-none">Contact</a> | <a href="#"
                    class="text-decoration-none">How To Adopt?</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
