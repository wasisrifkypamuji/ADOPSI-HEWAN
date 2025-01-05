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
                                <a href="#" class="btn btn-success d-block mt-8">Lihat Formulir</a>
                                <a href="{{ route('admin.adopsi.laporan', $adp->id_adopsi) }}"
                                    class="btn btn-success d-block mt-2">Lihat Laporan</a>
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
