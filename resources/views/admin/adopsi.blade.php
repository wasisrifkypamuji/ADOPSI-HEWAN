@extends('layout.navigasiadmin')

@section('content')
    <header class="bg-light py-3 text-center">
        <h1>Halaman Adopsi</h1>
    </header>

    <section class="container my-4">
        <div class="bg-light p-4 rounded mb-4">
            <p class="text-center">Gunakan pencarian cepat untuk menemukan peliharaan yang sesuai</p>
            <form action="{{ route('adopsi.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Jenis Hewan:</label>
                        <select name="jenis_hewan" class="form-control">
                            <option value="">Pilih Jenis Hewan</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->nama_kategori }}"
                                    {{ request('jenis_hewan') == $kat->nama_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Jenis Kelamin:</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Jantan" {{ request('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan
                            </option>
                            <option value="Betina" {{ request('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Usia:</label>
                        <input type="number" name="usia" class="form-control" min="0"
                            value="{{ request('usia') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn w-100"
                            style="background-color: #ff6b35; color: white;">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        @if ($hewan->isEmpty())
            <div class="alert alert-warning text-center">
                Belum ada data hewan.
            </div>
        @else
            <div class="row">
                @foreach ($hewan as $pet)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $pet->foto) }}" class="card-img-top"
                                alt="{{ $pet->nama_hewan }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $pet->nama_hewan }}</h5>
                                <div class="d-flex gap-4">
                                    <button class="btn btn-success">Ubah</button>
                                    <form method="POST" action="{{ route('admin.adopsi.delete', $pet->id_hewan) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus adopsi hewan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $hewan->links() }}
            </div>
        @endif
    </section>

    <!-- Pagination -->
    <section class="container text-center my-4">
        {!! $hewan->links() !!}
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
