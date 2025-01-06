@extends('layout.navigasiadmin')

@section('content')
    <header class="bg-light py-3 text-center">
        <h1>Laporan Adopsi {{ $adopsi->nama_hewan }}</h1>
    </header>

    <section class="container my-4">
        @if ($laporan->isEmpty())
            <div class="alert alert-warning text-center">
                Belum ada data laporan.
            </div>
        @else
            <div class="row">
                @foreach ($laporan as $adp)
                    <div class="col-md-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title h3 mb-4"><strong>Laporan
                                        {{ \Carbon\Carbon::parse($adp->created_at)->format('d F y') }}</strong></h5>
                                <div class="d-flex justify-content-start gap-4 mb-4">
                                    <!-- Image thumbnail -->
                                    <img src="{{ asset('storage/' . $adp->foto) }}" 
                                         alt="{{ $adp->adopsi->nama_hewan }}"
                                         style="width: 300px; cursor: pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal{{ $adp->id }}">

                                    <!-- Video thumbnail -->
                                    <div style="width: 300px; cursor: pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#videoModal{{ $adp->id }}">
                                        <video style="width: 100%;">
                                            <source src="{{ asset('storage/' . $adp->video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                                <p>{{ $adp->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Modal -->
                    <div class="modal fade" id="imageModal{{ $adp->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Foto {{ $adp->adopsi->nama_hewan }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $adp->foto) }}" 
                                         alt="{{ $adp->adopsi->nama_hewan }}"
                                         style="max-width: 100%; max-height: 80vh; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video Modal -->
                    <div class="modal fade" id="videoModal{{ $adp->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Video {{ $adp->adopsi->nama_hewan }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <video controls style="max-width: 100%; max-height: 80vh;">
                                        <source src="{{ asset('storage/' . $adp->video) }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $laporan->links() }}
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