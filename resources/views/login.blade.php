<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylesignup.css') }}">
    <style>
    body {
        background-image: url('{{ asset('css/Images/bglogin.webp') }}');
        background-size: cover;
        background-position: center;
    }
</style>

</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <h1 class="text-center mb-4">Login</h1>

                        <!-- Tampilkan pesan kesalahan jika ada -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <p class="text-muted" style="text-align: center;">Don't have an account? <a href="{{ route('signup') }}" class="text-primary">Sign up</a></p>

                        <form action="{{ route('login') }}" method="POST">
    @csrf 
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Enter your Username" required>
    @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="d-grid">
    <p class="text-muted text-end">
        <a href="{{ route('password.request') }}" class="text-primary">Saya Lupa Password</a>
    </p>
<button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
