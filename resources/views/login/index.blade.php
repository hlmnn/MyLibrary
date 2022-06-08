<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>{{ $title }}</title>

    <style>
        body {
            background: url('https://source.unsplash.com/YLSwjSy7stw') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark p-2">
        <div class="container-fluid mx-5 my-2">
            <a class="navbar-brand text-light fw-bold" href="/">MyLibrary</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href="#">Home</a>
                    </li> --}}
                </ul>
                <div class="d-flex">
                    <a href="/login"><button type="button" class="btn btn-primary">Sign In</button></a>
                </div>
            </div>
        </div>
    </nav>

    @if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Page Content -->
    <div class="container d-flex justify-content-center">
        <div class="card border-0 shadow my-5 w-50">
            <div class="card-body p-5">
                <h2 class="text-center">Halaman Login</h2>
                <hr>
                <form action="/login" method="POST">
                    @csrf
                    <div class="rounded p-4">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username anda" required value="{{ old('username') }}" autofocus>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password anda" required>
                            <input type="checkbox" onclick="showPass()"> Show Password
                        </div>
                        <button type="submit" class="btn btn-primary px-5 py-2 position-relative bottom-0 start-50 translate-middle-x">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
</body>
</html>