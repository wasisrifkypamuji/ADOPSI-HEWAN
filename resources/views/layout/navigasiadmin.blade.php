<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetAdopt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
.navbar{
    background-color: #78B3CE;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .navbar .nav-link:hover {
    background-color: #C9E6F0;
    color: #78B3CE;
    }
    
    .nav-button {
    position: absolute;
    top: 50%;
    background-color: #F96E2A;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    }
    
    .left-button {
    left: -10px;  
    }
    
    .right-button {
    right: -10px;
    }
    
    .bg-gray {
    margin-top: 50px;
    background-color: #726868;   
    padding: 30px; 
    border-radius: 10px; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 90%;
    }
    
    
    .navbar-brand{
    padding-right: 100px;
    }
    .navbar .nav-link {
    color: white; 
    }
    .btn-nav{
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    background-color: #F96E2A;
    }
    
    .btn-nav:hover{
    background-color: #e46a2e;
    color: white;
    }
    
    .navbar-nav {
    justify-content: left; 
    gap: 20px; 
    }
    
    .nav-item .btn {
    justify-items: right;
    }
    
    .profile-icon {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    .profile-icon img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .btn-edit, .btn-logout {
      width: 250px;
      height: 40px;
      margin: 5px;
    }

    footer {
    background-color: #78B3CE;
    color: white;
    padding: 20px 0;
  }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('Images Admin\Logo.png') }}" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ url('/admin/homeadmin') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Adopsi</a></li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.tambah-hewan') }}">Tambah Hewan</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Permintaan Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Riwayat Adopsi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Permintaan Donasi Hewan</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
  @auth
  <li class="nav-item">
    <a class="navbar-brand profile-icon" href="#" id="profileIcon">
      <img src="{{ asset('Images Admin\profil.png') }}" alt="Logo profil">
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
