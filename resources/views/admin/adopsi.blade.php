@extends('layout.navigasiadmin')

@section('content')
<header class="bg-light py-3 text-center">
    <h1>Halaman Adopsi</h1>
</header>

<section class="container my-4">
    <div class="bg-light p-4 rounded mb-4">
        <p class="text-center">Gunakan pencarian cepat untuk menemukan peliharaan yang sesuai</p>
        <form action="{{ route('admin.adopsi.index') }}" method="GET">
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
                        <option value="Jantan" {{ request('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                        <option value="Betina" {{ request('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Usia:</label>
                    <input type="number" name="usia" class="form-control" min="0" value="{{ request('usia') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn w-100" style="background-color: #ff6b35; color: white;">Cari</button>
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
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $pet->id_hewan }}">Detail</button>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $pet->id_hewan }}">Ubah</button>
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

                <!-- Modal Detail untuk setiap hewan -->
                <div class="modal fade" id="detailModal{{ $pet->id_hewan }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $pet->id_hewan }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $pet->id_hewan }}">Detail Hewan: {{ $pet->nama_hewan }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/'.$pet->foto) }}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="{{ $pet->nama_hewan }}">
                                <h3>{{ $pet->nama_hewan }}</h3>
                                <p>{{ $pet->deskripsi }}</p>
                                <div class="bg-light p-3 rounded">
                                    <p><strong>Ras:</strong> {{ $pet->ras }}</p>
                                    <p><strong>Jenis Kelamin:</strong> {{ $pet->jenis_kelamin }}</p>
                                    <p><strong>Usia:</strong> {{ $pet->usia }} tahun</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit untuk setiap hewan -->
                <div class="modal fade" id="editModal{{ $pet->id_hewan }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pet->id_hewan }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $pet->id_hewan }}">Edit Data Hewan: {{ $pet->nama_hewan }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('adopsi.update', $pet->id_hewan) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_hewan_{{ $pet->id_hewan }}" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama_hewan_{{ $pet->id_hewan }}" name="nama_hewan" value="{{ $pet->nama_hewan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ras_{{ $pet->id_hewan }}" class="form-label">Ras</label>
                                        <input type="text" class="form-control" id="ras_{{ $pet->id_hewan }}" name="ras" value="{{ $pet->ras }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="usia_{{ $pet->id_hewan }}" class="form-label">Usia</label>
                                        <input type="number" class="form-control" id="usia_{{ $pet->id_hewan }}" name="usia" value="{{ $pet->usia }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender_{{ $pet->id_hewan }}" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" id="gender_{{ $pet->id_hewan }}" name="jenis_kelamin" required>
                                            <option value="Jantan" {{ $pet->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                                            <option value="Betina" {{ $pet->jenis_kelamin == 'Betina' ? 'selected' : '' }}>Betina</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_{{ $pet->id_hewan }}" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi_{{ $pet->id_hewan }}" name="deskripsi" rows="4" required>{{ $pet->deskripsi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto_{{ $pet->id_hewan }}" class="form-label">Foto</label>
                                        <div class="mb-3">
                                        <img src="{{ asset('storage/' . $pet->foto) }}" alt="Foto {{ $pet->nama_hewan }}" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                        <input type="file" class="form-control" id="foto_{{ $pet->id_hewan }}" name="foto" accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

<footer class="bg-light text-center py-4">
    <div class="container">
        <h5>Findpet</h5>
        <p>Temukan teman setia Anda di Findpet - platform adopsi hewan terpercaya untuk memberi mereka rumah penuh kasih!</p>
        <p><a href="#" class="text-decoration-none">Contact</a> | <a href="#" class="text-decoration-none">How To Adopt?</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
