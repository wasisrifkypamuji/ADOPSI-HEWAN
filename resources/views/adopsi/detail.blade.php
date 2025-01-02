<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
    @extends('layout.navigasi')

    @section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/'.$hewan->foto) }}" 
                     class="img-fluid rounded" 
                     alt="{{ $hewan->nama_hewan }}">
            </div>
            <div class="col-md-6">
                <h1>{{ $hewan->nama_hewan }}</h1>
                <p class="text-muted">{{ $hewan->deskripsi }}</p>

                <div class="bg-light p-3 rounded mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-0">Ras</p>
                            <strong>{{ $hewan->ras }}</strong>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0">Jenis Kelamin</p>
                            <strong>{{ $hewan->gender }}</strong>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0">Umur</p>
                            <strong>{{ $hewan->umur }}</strong>
                        </div>
                    </div>
                </div>

                <button class="btn w-100" style="background-color: #ff6b35; color: white;">
                    Adopsi Sekarang
                </button>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>