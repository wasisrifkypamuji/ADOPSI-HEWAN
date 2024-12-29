<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
    <!-- Tambahkan Tailwind jika menggunakan class Tailwind -->
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

    <div class="bg-light p-4 rounded">
        <div class="row">
            @forelse($donations as $donation)
                <div class="col-md-6 mb-4">
                    <div class="d-flex">
                        <div class="me-3">
                            <img src="{{ Storage::url($donation->foto) }}" 
                                 alt="{{ $donation->nama_hewan }}"
                                 class="rounded"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <div>
                            <h4>{{ $donation->nama_hewan }}</h4>
                            <p>
                                @if($donation->status == 'proses')
                                    Sedang Diproses...
                                    <form action="{{ route('donasi.batalkan', $donation->id_kirim) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin membatalkan donasi?')">
                                            Batalkan
                                        </button>
                                    </form>
                                @else
                                    Donatur
                                    <a href="{{ route('donasi.show', $donation->id_kirim) }}" 
                                       class="btn btn-success">
                                        Lihat Detail
                                    </a>
                                @endif
                            </p>
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
</style>
@endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>