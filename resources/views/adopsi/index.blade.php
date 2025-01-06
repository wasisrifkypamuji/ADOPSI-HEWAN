<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Adopsi Hewan</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
   <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
   @extends('layout.navigasi')

   @section('content')
   <div class="container mt-4">
       @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
       <h1 class="text-center my-4">Pilih Peliharaanmu!!!</h1>
       
       <div class="bg-light p-4 rounded mb-4">
        <p class="text-center">Gunakan pencarian cepat untuk menemukan peliharaan yang sesuai</p>
        <form action="{{ route('adopsi.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Jenis Hewan:</label>
                    <select name="jenis_hewan" class="form-control">
                        <option value="">Pilih Jenis Hewan</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->nama_kategori }}" {{ request('jenis_hewan') == $kat->nama_kategori ? 'selected' : '' }}>
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

       @if($hewan->isEmpty())
           <div class="alert alert-warning text-center">
               Belum ada hewan yang tersedia untuk diadopsi.
           </div>
       @else
           <div class="row">
               @foreach($hewan as $pet)
               <div class="col-md-3 mb-4">
                   <div class="card h-100">
                       <img src="{{ asset('storage/'.$pet->foto) }}" 
                            class="card-img-top" 
                            alt="{{ $pet->nama_hewan }}"
                            style="height: 200px; object-fit: cover;">
                       <div class="card-body text-center">
                           <h5 class="card-title">{{ $pet->nama_hewan }}</h5>
                           <p class="text-muted mb-2">{{ $pet->nama_kategori }} - {{ $pet->gender }}</p>
                           <p class="text-muted mb-3">Usia: {{ $pet->umur }} Bulan</p>
                           <a href="{{ route('adopsi.show', $pet->id_hewan) }}" 
                              class="btn btn-sm" style="background-color: #ff6b35; color: white;">
                               Adopsi Sekarang
                           </a>
                       </div>
                   </div>
               </div>
               @endforeach
           </div>

           <div class="d-flex justify-content-center mt-4">
               {{ $hewan->links() }}
           </div>
       @endif
   </div>
   <style>
       .card {
           border-radius: 15px;
           overflow: hidden;
           box-shadow: 0 2px 5px rgba(0,0,0,0.1);
           transition: transform 0.3s ease;
       }
       .card:hover {
           transform: translateY(-5px);
       }
       .btn:hover {
           background-color: #e55a2b !important;
       }
   </style>
   @endsection

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>