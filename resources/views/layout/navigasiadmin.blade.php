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
        <li class="nav-item"><a class="nav-link" href="{{ url('/admin/homeadmin') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.adopsi.index') }}">Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.tambah-hewan') }}">Tambah Hewan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.permintaanadopsi') }}">Permintaan Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.adopsi.riwayat') }}">Riwayat Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('acc-donasi.index') }}">Permintaan Donasi Hewan</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        @auth('admin')
        <li class="nav-item">
          <a class="navbar-brand profile-icon" href="#" id="profileIcon">
            <img src="{{ asset('images/profil.png') }}" alt="Logo profil">
          </a>
        </li>
        <div class="profile-sidebar" id="profileSidebar">
          <div class="profile-header">
            <img src="{{ asset('images/profil.png') }}" alt="Profile Picture">
            <h3>{{ Auth::user()->username }}</h3>
            @if (Auth::user()->id_admin == 1)
              <a href="{{ route('admin.create') }}" class="btn btn-success btn-add">Tambah Admin</a>
            @endif
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-danger btn-logout">Logout</button>
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
