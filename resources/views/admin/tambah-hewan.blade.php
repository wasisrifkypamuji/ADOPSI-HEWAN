@extends('layout.navigasiadmin')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Kategori Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Kategori</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST" class="mb-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" 
                           placeholder="Nama Kategori" required value="{{ old('nama_kategori') }}">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                @error('nama_kategori')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </form>

            <div class="list-group">
                @foreach($kategori as $kat)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $kat->nama_kategori }}
                    <form action="{{ route('admin.kategori.delete', $kat->id_kategori) }}" 
                          method="POST" class="d-inline" 
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                            <input type="text" name="nama_hewan" 
                                   class="form-control @error('nama_hewan') is-invalid @enderror" 
                                   value="{{ old('nama_hewan') }}" required>
                            @error('nama_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori" 
                                    class="form-control @error('id_kategori') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" 
                                            {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ras</label>
                            <input type="text" name="ras" 
                                   class="form-control @error('ras') is-invalid @enderror" 
                                   value="{{ old('ras') }}" required>
                            @error('ras')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usia (bulan)</label>
                            <input type="number" name="umur" 
                                   class="form-control @error('umur') is-invalid @enderror" 
                                   value="{{ old('umur') }}" required min="0">
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" 
                                    class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="">Pilih Gender</option>
                                <option value="Jantan" {{ old('gender') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                                <option value="Betina" {{ old('gender') == 'Betina' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" 
                                    class="form-control @error('deskripsi') is-invalid @enderror" 
                                    rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" id="foto" 
                                   class="form-control @error('foto') is-invalid @enderror" 
                                   accept="image/*" required onchange="previewImage(this)">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="preview" src="#" alt="Preview" 
                                     class="img-thumbnail" style="max-height: 200px; display: none;">
                            </div>
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

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
    
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection