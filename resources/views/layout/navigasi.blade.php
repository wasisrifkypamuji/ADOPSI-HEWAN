<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetAdopt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stylehome.css') }}">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    .content-wrapper {
      min-height: 100%;
      display: flex;
      flex-direction: column;
    }

    footer {
      padding: 20px;
      margin-top: auto; 
      width: 100%;
    }
  </style>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
  <a class="navbar-brand" href="#">
    <img src="{{ asset('css/Images/Logo.png') }}" style="height: 40px;">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">AdopsiMu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('donasi.index') }}">Donasi Hewan</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><button class="btn-nav me-2" onclick="location.href='{{ route('signup') }}'">SignUp</button></li>
        <li class="nav-item"><button class="btn-nav me-2" onclick="location.href='{{ route('login') }}'">Login</button></li>
      </ul>
    </div>
  </div>
</nav>

<!-- konten -->
<div class="content-wrapper">
  @yield('content') 
</div>

<!-- footer -->
<footer>
  <div class="container text-center">
    <p>&copy; 2024 Adopsi Hewan. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
