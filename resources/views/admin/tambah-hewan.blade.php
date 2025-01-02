@extends('layout.navigasiadmin')

@section('content')
<div class="container mt-4">
    <!-- Kategori Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Kategori</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST" class="mb-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>

            <div class="list-group">
                @foreach($kategori as $kat)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $kat->nama_kategori }}
                    <form action="{{ route('admin.kategori.delete', $kat->id_kategori) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Tambah Hewan Section -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Hewan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hewan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama_hewan" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ras</label>
                            <input type="text" name="ras" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" name="umur" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="Jantan">Jantan</option>
                                <option value="Betina">Betina</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection