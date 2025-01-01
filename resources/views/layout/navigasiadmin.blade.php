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

    .profile-sidebar {
      padding: 20px;
      position: fixed;
      top: 0;
      right: -300px; 
      width: 300px;
      height: 100%;
      background-color: #fff;
      box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
      transition: right 0.3s ease;
      z-index: 1001;
    }

    .profile-header {
      text-align: center;
    }

    .profile-sidebar.active {
      right: 0; 
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      z-index: 1000;
    }

    .overlay.active {
      display: block;
    }

    .profile-header img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    margin-bottom: 10px;
  }

  .profile-icon img{
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }
  .profile-icon{
    }

    .btn-edit, .btn-logout {
      width: 250px;
      height: 40px;
      margin: 5px;
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
        <li class="nav-item"><a class="nav-link" href="#">Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Tambah Hewan</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Permintaan Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Riwayat Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Permintaan Donasi Hewan</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
  @auth
  <li class="nav-item">
    <a class="navbar-brand profile-icon" href="#" id="profileIcon">
      <img src="{{ asset('images/profil.png') }}" alt="Logo profil">
    </a>
  </li>
  <div class="profile-sidebar" id="profileSidebar">
    <div class="profile-header">
      <img src="{{ asset('images/profil.png') }}" alt="Profile Picture">
      <h3>{{ Auth::user()->username }}</h3>
      
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
