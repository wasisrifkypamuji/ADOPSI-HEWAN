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
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('css/Images/Logo.png') }}" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <a class="nav-link" href="{{ route('adopsi.index') }}">Adopsi</a>
        <li class="nav-item"><a class="nav-link" href="{{ route('adopsi.my-adoptions') }}">AdopsiMu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('donasi.index') }}">Donasi Hewan</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
  @auth
  <li class="nav-item">
    <a class="navbar-brand profile-icon" href="#" id="profileIcon">
<img 
  src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}" 
  class="rounded-circle">
</a>
  </li>
  <div class="profile-sidebar" id="profileSidebar">
    <div class="profile-header text-center">
        <img 
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}" 
            class="rounded-circle mb-3">
        <h3>{{ Auth::user()->username }}</h3>
        <div class="profile-info mt-4">
            <div class="info-container mb-3">
                <p class="info-label"><strong>Nama Lengkap</strong></p>
                <p class="info-value">{{ Auth::user()->nama_lengkap }}</p>
            </div>
            <div class="info-container mb-3">
                <p class="info-label"><strong>Email</strong></p>
                <p class="info-value">{{ Auth::user()->email }}</p>
            </div>
            <div class="info-container mb-3">
                <p class="info-label"><strong>Nomor Telepon</strong></p>
                <p class="info-value">{{ Auth::user()->no_telepon }}</p>
            </div>
            <div class="info-container mb-3">
                <p class="info-label"><strong>Alamat</strong></p>
                <p class="info-value">{{ Auth::user()->alamat }}</p>
            </div>
        </div>
        <button class="btn-nav btn-edit mt-3" onclick="window.location.href='{{ route('editprofil.show') }}'">Edit Profil</button> <br>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger btn-logout mt-2">Logout</button>
        </form>
    </div>
</div>

  <div class="overlay" id="overlay"></div>
  @else
  <li class="nav-item">
    <button class="btn-nav me-2" onclick="location.href='{{ route('signup') }}'">SignUp</button>
  </li>
  <li class="nav-item">
    <button class="btn-nav me-2" onclick="location.href='{{ route('login') }}'">Login</button>
  </li>
  @endauth
</ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="content-wrapper">
  @yield('content') 
</div>

<!-- Footer -->
<footer>
  <div class="container text-center">
    <p>&copy; 2024 Adopsi Hewan. All rights reserved.</p>
  </div>
</footer>

<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
